
function writeCell(cell,n){
  var txt="";
  n = (n==0) ? 10 : n;
  for(let i=0 ; i<n ; i++){
    txt+="|";
  }
  for(let j=n ; j<10 ; j++){
    txt+=".";
  }
  console.log(txt);
  cell.innerHTML=txt;
}

function displayPipes(nbVote,element){
  var n=Math.floor((nbVote-1)/10)+1;
  var cell=document.getElementById(element+"_"+n);
  writeCell(cell,(nbVote)%10);
}


function addVote(element){
  var candidat = document.getElementById(element+"77");
  var total = document.getElementById(element);
  var votes = parseInt(candidat.value);
  votes += 1;
  candidat.value=votes;
  total.innerHTML=votes;
  displayPipes(votes,element);
}

