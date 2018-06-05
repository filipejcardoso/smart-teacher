      <!-- START LEFT SIDEBAR NAV-->
      <aside>
        <ul class="side-nav fixed">
            <li class="default-color-1">
            <div class="row">
                <div class="col l12 default-text-color-2 sidenav_logo">
                  <img class="cursor-pointer" onclick="window.location='/'" src="/App/Views/_images/_sidenav/unesp-logo.png">
                </div>
                <div class="col l12 sidenav_user center">
                    <img onclick="window.location='/'" src="/App/Views/_images/_users/teacher.png" alt="" class="circle responsive-img valign sidenav_user_image cursor-pointer">
                </div>
                    <div class="col l12">
                        <ul id="profile-dropdown" class="dropdown-content">
                            <li><a href="/dashboard"></i>Perfil</a></li>
                            <li><a href="/login"></i>Sair</a></li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn center" href="#" data-activates="profile-dropdown"><?php echo $_SESSION['NOME_USUARIO']; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>

                    </div>
            </div>
            </li>
            
            <li><a href="\dashboard" class="waves-effect waves-cyan">
              <i class="material-icons">dashboard</i>Dashboard</a>
            </li>
            
            <li><a href="\selectdisciplina" class="waves-effect waves-cyan">
              <i class="material-icons">class</i>Criar Sala</a>
            </li>
            
            <li><a href="\listsalasativas" class="waves-effect waves-cyan">
              <i class="material-icons">important_devices</i>Tempo Real</a>
            </li>
            
            <li><a href="\listsalas" class="waves-effect waves-cyan">
              <i class="material-icons">timeline</i>Estatísticas</a>
            </li>
            
            <li><a href="\listdisciplinas" class="waves-effect waves-cyan">
              <i class="material-icons">question_answer</i>Gerenciar Questões</a>
            </li>
            
            <!--<li><a href="#" class="waves-effect waves-cyan">
              <i class="material-icons">subject</i>Meu Perfil</a>
            </li>-->

        </ul>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

