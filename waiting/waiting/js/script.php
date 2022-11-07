<script type="text/javascript">
<?php
  $dir="../image/";
  $liste=scandir($dir);


  
  function print_array($list){
      $count=0;
      echo "var images=new Array(";
      foreach($list as $el){
          if($el != "." && $el!=".."){
              if($count>0)
                  echo ",";
              echo $el;
              $count++;
          }
      }
      echo ");";
  }
print_array($liste); ?>
  var imgAc = randImage();

var colorArray = new Array("#0077b3","#007754","#003a5d","#ff8300","#d03f15","#65bc99","#6e74aa");
var actualColor = "";

var vector=new Array(0,0);

var coord=new Array(2);

var size = 200;

var count=0;

var limit = 5;

var step = 0.75;

var middle = new Array(window.innerWidth/2,window.innerHeight/2);
coord[0]=middle[0];
coord[1]=middle[1];

var canva = document.getElementById("canva");

canva.width=window.innerWidth;
canva.height=window.innerHeight;

var ctx=canva.getContext("2d");

var image=document.getElementById("image");

image.addEventListener('load', function(){
  ctx.drawImage(image, coord[0], coord[1], size, size);
  console.log("Draw image with size = ",size);
},false);

console.log(image);

function initVector(){
  var x=0, y=0;
  x=Math.random();
  y=Math.random();
  if(x<1)
    x+=1;
  if(y<1)
    y+=1;
  vector[0]=x*step;
  vector[1]=y*step;
  console.log(vector);
}

initVector();
function changeCanvasBg(){
  var chosenColor="";
  while((chosenColor=colorArray[Math.floor(Math.random()*colorArray.length)])==actualColor){}
  document.getElementById("canva").style.backgroundColor = chosenColor;
  actualColor=chosenColor;
}

function randImage(){
  var imgNew="";
  while((imgNew=images[Math.floor(Math.random()*images.length)])==imgAc){
  }
  imgAc=imgNew;
  return "../images/"+imgNew;
}

function moveImage(){
  ctx.clearRect(0,0,canva.width,canva.height);
  coord[1]+=vector[1]*step;
  coord[0]+=vector[0]*step;
  ctx.drawImage(image, coord[0], coord[1], size, size);
  if(coord[0]+size+vector[0] >= canva.width || coord[0]+vector[0] <= 0){
    vector[0]*=-1;
    changeCanvasBg();
    count++;
  }
  if(coord[1]+size+vector[1] >= canva.height || coord[1]+vector[1] <= 0){
    vector[1]*=-1;
    changeCanvasBg();
    count++;
  }
  if(count>=limit){
    const actualImages=(image.src).split("/");
    const actualImage=actualImages[0];
    image.src="image/"+randImage(actualImage);
    count=0;
  }
}

function stepch(n){
  step += n;
}

function stop(){
  clearInterval(inter);
}

var inter = setInterval(moveImage, 1);
</script>