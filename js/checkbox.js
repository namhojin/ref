function check(chkbox){
  if(chkbox.checked == true){
    location.href="http://192.168.56.222/ref/lend_page.php?id=insert";
  }
  else {
    location.href="http://192.168.56.222/ref/lend_page.php";
  }
}
