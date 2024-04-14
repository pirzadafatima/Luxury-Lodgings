<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Profile.css">
    <title>Admin Profile</title>
</head>
<?php include('connection.php');
   session_start();
   $uname = $_SESSION['uname'];
?>
<body>
    <div class = "hero">
        <nav>
            <img src="images/Logo.jpg" class="logo">
            <ul>
                <li><a href="mainRoom.html" > Rooms </a></li>
                <li><a href="#" > Car Rental </a></li>
                <li><a href="services.html" > Services </a></li>
                <li><a href="#blogsSection" > Blogs </a></li>
                <li><a href="adminQA.php" > FAQ's </a></li>
                <li><a href="Form.php" > Reviews </a></li>
                <li><a href="#contactUsSection" > Contact </a></li>
            </ul>
            <img src="images/Userr.png" class="userpic" onclick="togglemenu()">

            <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="images/Userr.png">
                    <h3> <?php echo $uname.'</br>'?> </h3>
                </div>
            <hr>

            <a href="AdminEditProfile.php" class="sub-menu-link">
                <img src="images/profile.png">
                <p>Edit Profile</p>
                <span>></span>
            </a>

            <a href="UpdateFacilities.php" class="sub-menu-link">
                <img src="images/setting.png">
                <p>Update Facilities</p>
                <span>></span>
            </a>
           
            <a href="SignOut.php" class="sub-menu-link">
                <img src="images/logout.png">
                <p>Sign Out</p>
                <span>></span>
            </a>


            </div>
            </div>


        </nav>
       
    </div>
    <section style="background-image: url('https://th.bing.com/th/id/R.fb071770f83d99469698c26ea165e01e?rik=09djKFASUL2Cbw&pid=ImgRaw&r=0');">
        <div class="overlay">
          <h1>Luxury Lodgings</h1>
          <p>Welcome to our luxurious hotels and car rentals</p>
        </div>
      </section>
      <div class="collage_container"></div>
  <!--blogs section-->
    <a href="https://codepen.io/mimikos/pen/vJBENm/" class="link" target="_blank"></a>
      <section>
          <div class="container">
            <h2>Latest Blog Posts</h2>
            <div class="blog-list" id="blogsSection">
              <article>
                <img src="https://i0.wp.com/theluxurytravelexpert.com/wp-content/uploads/2020/08/THE-EMPATHY-SUITE-PALMS-CASINO-RESORT-LAS-VEGAS.jpg?ssl=1" alt="Blog post image">
                <h3>Blog Post Title</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet risus tellus. Nunc quis tellus a tellus placerat fermentum. Nulla facilisi.</p>
                <a href="login.html">Learn More</a>
              </article>
              <article>
                <img src="https://www.redrockresort.com/wp-content/uploads/2020/12/RR-Standard-2-Queen.jpg" alt="Blog post image">
                <h3>Blog Post Title</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet risus tellus. Nunc quis tellus a tellus placerat fermentum. Nulla facilisi.</p>
                <a href="#">Learn More</a>
              </article>
              <article>
                <img src="https://media.autoexpress.co.uk/image/private/s--X-WVjvBW--/f_auto,t_content-image-full-desktop@1/v1575317248/autoexpress/2019/11/01_40.jpg" alt="Blog post image">
                <h3>Blog Post Title</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet risus tellus. Nunc quis tellus a tellus placerat fermentum. Nulla facilisi.</p>
                <a href="#">Learn More</a>
              </article>
            </div>
          </div>
        </section>
        
     <!-- Services section -->
     <section id="services">
      <h2>Our Services</h2>
      <div class="services-container">
        <div class="service">
          <div class="service-image" style="background-image: url('https://bwrentacar.com/wp-content/uploads/2022/09/Rolls-Royce-Cullinan-for-rent.jpg');"></div>
          <h3>Car Rental</h3>
          <p>Rent a car for your trip with our reliable and affordable car rental service.</p>
        </div>
        <div class="service">
          <div class="service-image" style="background-image: url('https://ca-times.brightspotcdn.com/dims4/default/5b5d62b/2147483647/strip/true/crop/5041x3361+0+0/resize/1200x800!/quality/80/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2F53%2F82%2Fbf3688e94bd6bde6821999ec68f5%2Ftaylormade.jpg');"></div>
          <h3>Golf</h3>
          <p>Let us help you plan and execute the perfect event with our professional event planning service.</p>
        </div>
        <div class="service">
          <div class="service-image" style="background-image: url('https://www.redrockresort.com/wp-content/uploads/2020/12/RR-Standard-2-Queen.jpg');"></div>
          <h3>Room Service</h3>
          <p>Enjoy delicious meals and snacks in the comfort of your room with our room service.</p>
        </div>
        <div class="service">
          <div class="service-image" style="background-image: url('https://media.istockphoto.com/id/1181456782/photo/3d-render-of-luxury-hotel-lobby-and-reception.jpg?s=612x612&w=0&k=20&c=w5yIBYGq0-yPeM-_exf0paBcm6mtZB2qYaUlKQwQBrA=');"></div>
          <h3>In Door Dining </h3>
          <p>Enjoy delicious meals and snacks in the comfort of your room with our room service.</p>
        </div>
      </div>
    </section>
    <section id="pricing">
      <h2>Pricing</h2>
      <div class="pricing-container">
        <div class="pricing free">
          <h3>Free</h3>
          <ul>
            <li class="bold">
              $0
            </li>
            <li>All users can access all our services.</li>
            <li>No hidden costs or fees.</li>
            <li>Limited Discount.</li>
          </ul>
          <a href="login.html">Sign up for Free</a>
        </div>
        <div class="pricing premium">
          <h3>Premium</h3>
          <ul>
            <li class="bold">
              $100
            </li>
            <li>
              Additional Discount
            </li>
            <li>All users can access all our services.</li>
            <li>No hidden costs or fees.</li>

            <li>Monthly subscription fee applies.</li>
          </ul>
          <a href="login.html">Sign up for Premium</a>
        </div>
      </div>
    </section>  
    <section class="contact-section" id="contactUsSection">
      <h2>Contact Us</h2>
      <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <input type="submit" value="Send">
      </form>
    </section>
</div>
      <script>
          var options = {
        container:document.querySelector(".collage_container"),
        piecesNum:50,
        imgSrc : "https://cdn.businesstraveller.com/wp-content/uploads/fly-images/1229000/Soneva-Jani_edited-916x516.jpg"
        
      }
      
      
      function ImageCollage(defaults)
      {
        var container = defaults.container;
        var containerWidth = container.offsetWidth;
        var containerHeight = container.offsetHeight;
        var containerStyle = container.currentStyle || window.getComputedStyle(container);
        var piecesNum = defaults.piecesNum;
        var levelIndex = Math.floor(piecesNum * 0.75);
        var maxsizeX = Math.round(container.offsetWidth/2);
        var maxsizeY = Math.round(container.offsetHeight/2);
        var offset = 15;
        var strength = 3;
        
        for (var i=0; i < piecesNum; i++)
          {
            var piece = document.createElement('div');
            piece.className = "collage_piece";
            
           
            if(i < levelIndex){
              piece.classList += " level_1";     
              piece.dataset.level = 1;
              piece.style.width = getRandomInt(100,  maxsizeX) + "px";
              piece.style.height = getRandomInt(100, maxsizeY) + "px";
              
            }else{
              piece.classList += " level_2";
              piece.dataset.level = 2;
              piece.style.width = getRandomInt(40,  maxsizeX/2) + "px";
              piece.style.height = getRandomInt(40, maxsizeY/2) + "px";
            }
                  
            piece.style.backgroundImage = "url("+defaults.imgSrc+")";      
            container.appendChild(piece);
            
            piece.dataset.offset = getRandomInt(strength, strength*2*piece.dataset.level);
            piece.style.backgroundSize = ""+ containerWidth +"px "+ containerHeight +"px";
            piece.style.left = getRandomInt(0, containerWidth-piece.offsetWidth) + "px";
            piece.style.top = getRandomInt(0, containerHeight-piece.offsetHeight) + "px";
            piece.style.backgroundPosition = -(piece.offsetLeft) + "px " + (-piece.offsetTop) + "px";
            
            console.log(containerStyle.marginLeft, containerStyle.marginTop);
          }
        
        window.addEventListener("mousemove", function(e){
          var pieces = container.querySelectorAll(".collage_piece");
          var xpos, ypos, mouseX, mouseY, levelNum, off;
          
          
          if (!mie) {
              mouseX = e.pageX; 
              mouseY = e.pageY;
          }
          else {
              mouseX = event.clientX + document.body.scrollLeft;
              mouseY = event.clientY + document.body.scrollTop;
          }
          
          for (var p=0, l=pieces.length; p < l ; p++)
            {
              levelNum = pieces[p].dataset.level;
              off = pieces[p].dataset.offset;
              xpos = ( -mouseX/2 + containerWidth/2) / (off - levelNum);
              ypos = ( -mouseY/2 + containerHeight/2) / (off - levelNum);
              TweenMax.set(pieces[p],  {x:xpos, y:ypos});
            }
        })
        
        
        var mie = (navigator.appName == "Microsoft Internet Explorer") ? true : false;  
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
      }  
      ImageCollage(options);
      
        let subMenu = document.getElementById("subMenu");

        function togglemenu()
        {
            subMenu.classList.toggle("open-menu");
        }

    </script>
</body>
</html>