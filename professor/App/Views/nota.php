<?php
if(!isset($_SESSION))
     session_start();
?>

<script language="javascript" type="text/javascript">
 var keyWords = new Array( "abstract", "assert", "boolean", "break", "byte", "case", "catch", "char", "class", "const", "continue", "default", "do", "double", "else", "enum", "extends", "final", "finally", "float", "for", "goto", "if", "implements", "import", "instanceof", "int", "interface", "long", "native", "new", "package", "private", "protected", "public", "return", "short", "static", "strictfp", "super", "switch", "synchronized", "this", "throw", "throws", "transient", "try", "void", "volatile", "while", "true", "false", "null" );
 var flowerBraces = new Array("}","{");
 var finalText = "";
 var keyWordStartTag = "<span style='font-weight:bold;color:#7B0052;'>"
  
var preStartTag = "<pre style='text-align: left; border: 1px dashed #008DEF; line-height: 18px; padding: 15px; font-size: 13px; font-family:'Courier New', Courier, monospace; overflow: auto;'>";
 
 var flowerBraceStartTag ="<span style='font-weight:bold;color:#D3171B'>"
 
 var stringStartTag = "<span style='color:#2A00FF'>";
 
 var commentStartTag = "<span style='color:#3F7F5F'>";
 
 var javaDocStartTag = "<span style='color:#3F5FBF'>";
 
 var annotationStartTag = "<span style='color:#646464'>"
   
 var append = true;
 var spanEndtag = "</span>"
 var preEndTag = "</pre>"
 
 function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
    }
    
function startsWith(subString, sourceString){
    if(sourceString.substr(0, subString.length) == subString){
      return true;
    }
    return false;
}

function processKeyWord(token){
 //alert("Processing Token :"+token );
 if(token == undefined) return;
 //check if it is present in the keyWord list
 if(keyWords.indexOf(token) != -1){
   enclosedText = keyWordStartTag + token + spanEndtag;
   finalText = finalText.substring(0,finalText.length-token.length);
   finalText = finalText + enclosedText;
   //alert("finalText :" + finalText );
  }
}

function processFlowerBraces(flowerBrace){
 formattedBrace = flowerBraceStartTag + flowerBrace + spanEndtag;
 
 finalText = finalText + formattedBrace;
 append = false;
}

function processDoubleQuotes(index,sourceText){

 var nextChar = "";
 var stringLiteral = '"';
 //alert("Found \" at index "+index);
 //read everything till the next "
 //be CAREFUL about the escape sequence
 while(nextChar!='"'){
  index++;
  nextChar = sourceText.charAt(index);
  //alert("Next Char = "+nextChar+" at "+index);
  if(nextChar == '\\'  ){
   switch(sourceText.charAt(index+1)){
    case '"':
      stringLiteral = stringLiteral + "\\\"";
      index++;
      break;
    case '\\':
      stringLiteral = stringLiteral + "\\\\";
      index++;
      break;
    default:
      stringLiteral = stringLiteral + nextChar;
      break;
    
   }//end of switch
   //escape sequenced \\ or \" found , dont end parse here
  }else if(nextChar == '<' || nextChar == '>'){
   stringLiteral = stringLiteral + htmlEscape(nextChar);
  }else{ 
   stringLiteral = stringLiteral + nextChar;
  }
 }//end of while
 
 //paint it blue
 paintedString = stringStartTag + stringLiteral + spanEndtag;
 finalText = finalText + paintedString;
 return index;

}

function processSingleQuotes(index,sourceText){
 var nextChar = "";
 var stringLiteral = "'";
 //alert("Found \" at index "+index);
 //read everything till the next 
 //be CAREFUL about the escape sequence
 while(nextChar!="'"){
  index++;
  nextChar = sourceText.charAt(index);
  //alert("Next Char = "+nextChar+" at "+index);
  if(nextChar == '\\'  ){
   switch(sourceText.charAt(index+1)){
    case "'":
      stringLiteral = stringLiteral + "\\\'";
      index++;
      break;
    case "\\":
      stringLiteral = stringLiteral + "\\\\";
      index++;
      break;
    default:
      stringLiteral = stringLiteral + nextChar;
      break;
    
   }//end of switch
   //escape sequenced \\ or \' found , dont end parse here
  }else if(nextChar == '<' || nextChar == '>'){
   stringLiteral = stringLiteral + htmlEscape(nextChar);
  }else{
   stringLiteral = stringLiteral + nextChar;
  }
 }//end of while
 
 //paint it blue
 paintedString = stringStartTag + stringLiteral + spanEndtag;
 finalText = finalText + paintedString;
 return index;
}

function processMultilineComment(index,sourceText){
  var nextChar = "";
  var multiLineComment = "/*";
  /*The current index points at /, we will increment it by 1
   because stringLiteral has already been filled with 2 chars
   Why increment by 1?
   Because we start the loop below by incrementing the index  
   */
  index++;
  
  //read everything until */ is found
  while(true){
   index++;
   nextChar = sourceText.charAt(index);
   if(nextChar == '*' && sourceText.charAt(index+1) =='/' )
    break;
   if(nextChar == '<' || nextChar == '>'){
    multiLineComment = multiLineComment + htmlEscape(nextChar);
   }else{
    multiLineComment = multiLineComment + nextChar;
   }
  }
  
  multiLineComment += "*/";
  var paintedMLComment =""
  if(startsWith("/** ",multiLineComment) || startsWith("/**\t",multiLineComment) || startsWith("/**\n",multiLineComment)){
   paintedMLComment = javaDocStartTag + multiLineComment + spanEndtag;
  }else{
   paintedMLComment = commentStartTag + multiLineComment + spanEndtag;
  }
  finalText = finalText + paintedMLComment;
  index++;//point it to the / char which ends the comment
  return index;
  
}

function processSingleLineComment(index,sourceText){
  var nextChar = "";
  var singleLineComment = "//";
  /*The current index points at /, we will increment it by 1
   because stringLiteral has already been filled with 2 chars
   Why increment by 1?
   Because we start the loop below by incrementing the index  
   */
  index++;
  
  //read everything until newline --&gt; \n is found
  while(true){
   index++;
   nextChar = sourceText.charAt(index);
   if(nextChar == '\n' )
    break;
   if(nextChar == '<' || nextChar == '>'){
    singleLineComment = singleLineComment + htmlEscape(nextChar);
   }else{
    singleLineComment = singleLineComment + nextChar;
   }
  }
  
  singleLineComment += "\n";
  var paintedComment = commentStartTag + singleLineComment + spanEndtag;
  finalText = finalText + paintedComment;
  return index;

}


function htmlEscape(currentChar){
 if(currentChar == '<')
  return "&lt;"
 else if(currentChar == '>')
  return "&gt;"
}
//TO BE DONE
function processAnnotations(){
  var nextChar = "";
  var annotation = "@";
  
}
function java2html(pInput,pOutput)
{
  finalText = "";
  document.getElementById(pOutput).innerHTML =  "";

  var sourceText = $("#"+pInput).val();
  sourceText = sourceText.trim();
  var readToken ="";
  var index = 0

for (index=0 ;index < sourceText.length ; index++)
{
  var currentChar = sourceText.charAt(index);
  append = true;

  if (currentChar == ';' || currentChar == '\t' || currentChar == ' ' || currentChar == '\n' || currentChar == '(' || currentChar == ')')
  {
    processKeyWord(readToken);
    finalText = finalText + currentChar;
    readToken = "";
    append = false; 
  }
  else if (currentChar =="+" || currentChar == '-' ||  currentChar == '*' || currentChar == '=' )
  {
    finalText = finalText + currentChar;
    readToken = "";
    append = false;
  }
  else if (currentChar == '}' || currentChar == '{' )
  {
    processKeyWord(readToken);
    processFlowerBraces(currentChar);
    readToken = "";
    append = false;
  }
  else if(currentChar =='"')
  {
    index = processDoubleQuotes(index,sourceText);
    readToken="";
    append = false;
  }
  else if(currentChar =="'")
  {
    index = processSingleQuotes(index,sourceText);
    readToken="";
    append = false;
  }
  else if(currentChar == '/' && sourceText.charAt(index+1) == '*')
  {
    index = processMultilineComment(index,sourceText);
    readToken = "";
    append = false;
  }
  else if(currentChar == '/' && sourceText.charAt(index+1) == '/')
  {
    //alert("processing SingleLine comment");
    index = processSingleLineComment(index,sourceText);
    readToken = "";
    append = false;
  }
  else if(currentChar == '<' || currentChar == '>' )
  {
  currentChar = htmlEscape(currentChar);
  finalText = finalText + currentChar;    
    readToken = "";
    append = false;
  }
  else
     readToken = readToken +  currentChar;
  if(append)
   finalText = finalText + currentChar;
 }

  document.getElementById(pOutput).innerHTML =  preStartTag + finalText + preEndTag
}

</script>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/nota.css">
    <link rel="stylesheet" href="/App/Views/_includes/_css/prova.css">
    <body>
    <main>

    	<center><h1>SUA NOTA É: <?php echo number_format($nota_final,'2'); ?></h1></center>
        <div class="row box_relatorio">
          <div class="col s12 center"><h5>RELATÓRIO</h5></div>
          <div class="col s4 center"><h5>CORRETAS: <?php echo number_format($numero_questoes_correta,'2'); ?><span id="alunos_total"></span></h5></div>
          <div class="col s4 center"><h5>INCORRETAS: <?php echo number_format($numero_questoes_incorreta,'2'); ?><span id="alunos_finalizado"></span></h5></div>
          <div class="col s4 center"><h5>NÃO RESPONDIDAS: <?php echo number_format($numero_questoes_nao_respondida,'2'); ?><span id="alunos_restante"></span></h5></div>
        </div>



        <div class="row all_questions">
          <div class="col s12">
          <center><h3>CORREÇÃO</h3></center>
          <?php $i=0; foreach ($questoes as $questao) {?>

          <div class="row box_question">
          <?php $k=0; foreach ($questoes_textos[$i] as $questao_texto) {?>
            <div class="col s12">
              <h5><?php if($k==0)echo ($i+1)." - ";echo $questao_texto->getTexto();?> </h5>
            </div>
          
            <div class="col s12">
              <code id="output_<?php echo $questao->getId().'_'.$k; ?>">
              </code>
            </div>

            <textarea class="textarea_prova" id="input_<?php echo $questao->getId().'_'.$k; ?>"><?php echo $questao_texto->getCodigo(); ?></textarea>

            <?php if($questao_texto->getCodigo()!="") { ?>
            <script type="text/javascript">java2html('input_<?php echo $questao->getId().'_'.$k; ?>','output_<?php echo $questao->getId().'_'.$k; ?>')</script>
            <?php } ?>

            <?php $k++; } ?>

            <div class="col s12 box_answer">
              <?php $j=1; foreach ($respostas[$i] as $resposta) {?>
              <p class="box_answer_col <?php if($resposta->getCorreta() == 1) echo'green lighten-2'; else if($sala_questoes[$i]->getResposta() == $resposta->getId()) echo 'red lighten-2';else echo 'grey lighten-2';?>">
                <input name="group_answer<?php echo $i;?>" type="radio" id="radio<?php echo $i; echo $j; ?>" <?php if($sala_questoes[$i]->getResposta() == $resposta->getId()) echo "checked"; ?> />
                <label for="radio<?php echo $i; echo $j; ?>" class="grey-text text-darken-3 box_answer_label"><?php echo $resposta->getTexto();?></label>
              </p>
              <?php $j++; } ?>
              <p class="box_answer_col <?php if($sala_questoes[$i]->getResposta() == 0) echo'lime lighten-2'; else echo 'grey lighten-2';?> ">
                <input name="group_answer<?php echo $i;?>" type="radio" id="radio_not_<?php echo $i; ?>" <?php if($sala_questoes[$i]->getResposta() == 0) echo "checked"; ?>/>
                <label for="radio_not_<?php echo $i; ?>" class="grey-text text-darken-2 box_answer_label"><strong>NÃO RESPONDER</strong></label>
              </p>
            </div>
          </div>
          <?php $i++;} ?>

          </div>
          </div>


    </main>
    </body>

</html>
<script>
