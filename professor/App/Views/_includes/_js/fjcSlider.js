    /*=========== SLIDER JS ==========*/
    function fjcSlider(pObj,pFolder,pImages,pImageClass,pNavClass)
    {
      /*----------campos----------*/
      var nameObj = pObj;
      
      var classImage = pImageClass;
      var length = classImage.length;

      var images = pImages;
      var size = (images[0]).length;

      var folder = pFolder;

      var classImage = pImageClass;

      var classNav = pNavClass;

      var posicaoAtual = 0;

      var timer;

      /*-------metodos publicos------------*/
      this.nextImage = nextImage;
      this.backImage = backImage;
      this.setImage = setImage;
      this.start = start;

      /*========IMPLEMENTACAO=========*/
      function start(){
          montarLayout();
          setImage(posicaoAtual,0);
          startTimer();
      }

      function nextImage(){
        posicaoAtual++;
        if(posicaoAtual>=size)
          posicaoAtual = 0;

        setImage(posicaoAtual,0);
      }

      function backImage(){
        posicaoAtual--;
        if(posicaoAtual<0)
          posicaoAtual = size - 1;

        setImage(posicaoAtual,0);
      }

      function setImage(posicao,restart){
          posicaoAtual = posicao;
          
          setBackground(posicao);

          for(var i=0;i<length;i++)
            $("."+classImage[i]).attr('src',pFolder[i] + "/" + (images[i])[posicao]);

          if(restart!=0)
            restartTimer();
      }

      /*-------timer-----------*/
      function restartTimer()
      {
        clearInterval(timer);
        timer = setInterval(nextImage,5000);
      }

      function stopTimer()
      {
        clearInterval(timer);
      }

      function startTimer()
      {
          timer = setInterval(nextImage,5000);
      }

      /*--------------layout-----------------*/
      function setBackground(posicao){
        clearBackground();        
        $("#fjcSliderDivInner" + posicao).css( "background-color", "#ff0000" );
      }

      function clearBackground()
      {
        for(var i=0;i<size;i++)
          $("#fjcSliderDivInner" + i).css( "background-color", "#ccc" );
      }

      function montarLayout(){
        var espacamento = 5;
        var width = 20;
        var height = 5;

        $("."+classNav).append("<div id='fjcSliderDivOuter'></div>");
        $("#fjcSliderDivOuter").css( "margin", "0 auto" );
        $("#fjcSliderDivOuter").css( "width", (width+espacamento)*size + "px" );
        $("#fjcSliderDivOuter").css( "height", espacamento+"px");
        $("#fjcSliderDivOuter").css( "margin-bottom", "10px");

        for(var i=0;i<size;i++)
        {
          $("#fjcSliderDivOuter").append("<div id='fjcSliderDivInner"+i+"' onclick='"+nameObj+".setImage("+i+",1)'>&nbsp;</div>");
          $("#fjcSliderDivInner" + i).css( "background-color", "#ccc" );
          $("#fjcSliderDivInner" + i).css( "width", width+"px" );
          $("#fjcSliderDivInner" + i).css( "height",height+ "px" );
          $("#fjcSliderDivInner" + i).css( "margin-left", espacamento + "px" );
          $("#fjcSliderDivInner" + i).css( "display", "inline-block" );
          $("#fjcSliderDivInner" + i).css( "cursor", "pointer" );
        }
      }
   }
