   
<?php 
   error_reporting(E_ALL);
   ini_set('display_errors', 'on');
   mb_internal_encoding('UTF-8');
   include 'header.php'; 
?>
      <main class="main" id="main">

         <section class="effect">
            <div class="back">
               <div class="back__in back__content">
                  <div class="back__text">
                     <h2 class="back__title">Sign in</h2>
                     <p class="back__description">Sign in here if you have account</p>
                     <a href="#" class="btn btn__line back__btn goLeft skew"><span>Sign in</span></a>
                  </div>
               </div>
               <div class="back__up back__content">
                  <div class="back__text">
                     <h2 class="back__title">Sign up</h2>
                     <p class="back__description">Sign up here if you don’t have account</p>
                     <a href="#" class="btn btn__line back__btn goRight skew"><span>Sign up</span></a>
                  </div>
               </div>
            </div>
            <div class="slideBox">
               <div class="content-layer">
                  <div class="content-layer__layer">
                     <div class="content-layer__form">
                        <form action="#" class="login" name="signin" id="signin">
                           <h3 class="content-layer__title content-layer__title_white">Sign in</h3>
                           <div class="social">
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-fb"></i></a>
                              </div>
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-gl"></i></a>
                              </div>
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-in"></i></a>
                              </div>
                           </div>
                           <div class="content-layer__item">
                              <input class="content-layer__inp inp" id="login" name="login" type="text" placeholder="Login">
                              <p class="content-layer__err errors"></p>
                           </div>
                           <div class="content-layer__item">
                              <span class="content-layer__eye"></span>
                              <input class="content-layer__inp inp" type="password" id="password" name="password" placeholder="Password">
                              <p class="content-layer__err errors"></p>
                           </div>
                           <div class="content-layer__buttons">
                              <button class="content-layer__btn btn btn__fill skew skew_bl"><span>Log in</span></button>
                           </div>
                        </form>
                     </div>                     
                  </div>
                  <div class="content-layer__layer">
                     <div class="content-layer__form">
                        <form action="#" class="login" name="signup" id="signup">
                           <h3 class="content-layer__title content-layer__title_white">Sign up</h3>
                           <div class="social">
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-fb"></i></a>
                              </div>
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-gl"></i></a>
                              </div>
                              <div class="social__col">
                                 <a href="#" class="social__link"><span></span><i class="icon-in"></i></a>
                              </div>
                           </div>
                           <div class="content-layer__item">
                              <input class="content-layer__inp inp" type="text" name="login" placeholder="Login">
                              <p class="content-layer__err errors"></p>
                           </div>
                           <div class="content-layer__item">
                              <span class="content-layer__eye"></span>
                              <input class="content-layer__inp inp" type="password" name="password" placeholder="Password">
                              <p class="content-layer__err errors"></p>
                           </div>                           
                           <div class="content-layer__item">
                              <span class="content-layer__eye"></span>
                              <input class="content-layer__inp inp" type="password" name="confirm_password" placeholder="Confirm password">
                              <p class="content-layer__err errors"></p>
                           </div>                           
                           <div class="content-layer__item">
                              <input class="content-layer__inp inp" type="email" name="email" placeholder="E-mail">
                              <p class="content-layer__err errors"></p>
                           </div>                           
                           <div class="content-layer__item">
                              <input class="content-layer__inp inp" type="text" name="name" placeholder="Name">
                              <p class="content-layer__err errors"></p>
                           </div>                           
                           <div class="content-layer__buttons">
                              <button class="content-layer__btn btn btn__fill skew skew_bl"><span>Log in</span></button>
                           </div>
                        </form>
                     </div>                     
                  </div>
               </div>
            </div>
         </section>

      </main>
<?php 
   include 'footer.php';
?>