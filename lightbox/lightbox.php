<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

h2 {
  text-align: center;
  margin-top: 20px;
  color: #333;
}

.row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding: 20px;
}

.column {
  flex: 1 1 22%;
  max-width: 22%;
  padding: 8px;
  margin: 10px;
  transition: transform 0.2s;
}

.column img {
  width: 100%;
  height: auto;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s, transform 0.3s;
}

.column img:hover {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  transform: scale(1.05);
}



/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 300px;
  padding-top: 50px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9);
  overflow: hidden;
}

/* Modal Content */
.modal-content {
  position: relative;
  margin: auto;
  width: 90%;
  max-width: 500px;
  animation: fadeIn 0.3s;
}

/* Close Button */
.close {
  color: #aaa;
  position: absolute;
  top: 15px;
  right: 25px;
  font-size: 30px;
  font-weight: bold;
  transition: color 0.3s;
}

.close:hover {
  color: #f2f2f2;
  cursor: pointer;
}

.mySlides {
  display: none;
}

/* Navigation Buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  color: white;
  font-size: 20px;
  font-weight: bold;
  padding: 12px;
  background-color: rgba(0, 0, 0, 0.6);
  border-radius: 50%;
  transition: background-color 0.3s;
}

.prev:hover, .next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

.prev {
  left: 10px;
}

.next {
  right: 10px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 10px 16px;
  color: white;
  font-size: 16px;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
</style>
<body>

<h2>Lightbox</h2>


<div class="row">
    <?php 
    $dir_path = "uploads/";//my folder name under the project that my classmate do in the morning, I am also moving the folder uploads to this folder.
    $extensions_array = array('jpg', 'png', 'jpeg', 'gif'); // file extensions of the pictures passed by my classmate in my localhost.
    
    if (is_dir($dir_path)) {// file path of the picture, excuted by php code.
        $files = scandir($dir_path);
        $slideNumber = 1;

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $file_ext = pathinfo($file, PATHINFO_EXTENSION);

                if (in_array($file_ext, $extensions_array)) {
                    echo "<div class='column'>";
                    echo "<img class='demo cursor' src='$dir_path$file' onclick='openModal(); currentSlide($slideNumber)' alt='Image $slideNumber'>";
                    echo "</div>";
                    $slideNumber++;
                }
            }
        }
    }
    ?>
</div>

<div id="myModal" class="modal">
  <span class="close" onclick="closeModal()">&times;</span>
  <div class="modal-content">
      <?php 
      $slideNumber = 1;//starting number when picture start to slide.
      foreach ($files as $file) {
          if ($file !== '.' && $file !== '..') {
              $file_ext = pathinfo($file, PATHINFO_EXTENSION);

              if (in_array($file_ext, $extensions_array)) {//array, in this part is the sequence of the pictures that will show in the interface part.
                  echo "<div class='mySlides'>";
                  echo "<div class='numbertext'>$slideNumber / " . (count($files) - 2) . "</div>";
                  echo "<img src='$dir_path$file' style='width:100%','height:50%'>";
                  echo "</div>";
                  $slideNumber++;
              }
          }
      }
      ?>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a> <!-- button to navigate the pictures-->
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
      <div class="caption-container"><!-- image number, which i inputted to see how many pictures are given to me.-->
        <p id="caption"></p>
      </div>
  </div>
</div>


<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}//Javascript Code
</script>
</body>
</html>