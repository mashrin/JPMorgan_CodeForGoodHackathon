<!doctype html>
<?php session_start();?>
<html>
<head>


</head>
<body>

<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 4px 0;
    border: none;
    cursor: pointer;
    width: 50%;
}
/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}
/* Float cancel and signup buttons and add an equal width */
.signupbtn,.cancelbtn {
    position:relative;
    float: 600px;
    width: 10%;
}
/* Add padding to container elements */
.container {
    padding: 16px;
}
/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body style="background:url(signupimage.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;background-size: cover;">
<h2 style="margin: 20 auto; text-align: center;color:white;fontsize: 60">REGISTER</h2>

<form action="/action_page.php" style="border:5px solid #ccc">
  <div class="container" style="margin: 0 auto; text-align: center;">
  <label style ="color:white;"><b>First Name</b></label>
  <input type="text" placeholder="First Name" id="name1" style="width:150px;position:relative;left: 63px;" required><br/>
  <label style ="color:white;"><b>Last Name</b></label>
  <input type="text" placeholder="Last Name" id="name2" style="width:150px;position:relative;left :63px;" required><br/>
  <label style ="color:white;"><b>Phone Number</b></label>
  <input type="text" placeholder="Phone Number" id="num" style="width:150px;position:relative; left :50px;"required><br/>
  <label style ="color:white;"><b>Education</b></label>
  <input type="text" placeholder="Education" id="e" style="width:150px;position:relative; left :65px;"required><br/>
  <label style ="color:white;"><b>Password </b></label>
  <input type="password" placeholder="Enter Password" id="psw" style="width:150px; position:relative; left :70px;"required><br/>
 
  <br>
  <label style ="color:white;"><b>Upload the image of the student</b></label>

  <input type="file" name="fileToUpload" style ="color:white" id="fileToUpload">
  <br>
</form>
<br/>
    <div class="clearfix">
      <button type="button" class="signupbtn" onclick=writeUserData();>Sign Up</button>
	  <form action="webcam (1).php" style="width:20px; height: 10px; margin-top:10px;" method="post">
	  <input type="submit" name="login">Login</input>
	  </form>
    </div>
  </div>

</body>

<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
<script>
	
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBAHmBwap-v7Vk11gDm94yzu8OVneyotQ8",
    authDomain: "amoghweb.firebaseapp.com",
    databaseURL: "https://amoghweb.firebaseio.com",
    projectId: "amoghweb",
    storageBucket: "",
    messagingSenderId: "516595991998"
  };
  firebase.initializeApp(config);
  
  
  var database= firebase.database();
  
  function writeUserData() {
	  
	  var first= document.getElementById("name1").value;
	  var last = document.getElementById("name2").value;
	  var phn = document.getElementById("num").value;
	  var edu= document.getElementById("e").value;
	  var pass = document.getElementById("psw").value;
	  document.getElementById("name1").value="";
	  document.getElementById("name2").value="";
	  document.getElementById("num").value="";
	  document.getElementById("e").value="";
	  document.getElementById("psw").value="";
	  
	  
		var file = document.querySelector('input[type=file]').files[0];
		var fr= new FileReader();
		 		var im;
		//alert(fr.result);
		fr.addEventListener("load", function () {
		im = fr.result;
		}, false);
		fr.readAsDataURL(file);
		
		firebase.database().ref('users/' + phn).set({
		first: first,
		last: last,
		profile_picture : im,
		phone : phn,
		education: edu,
		pass :pass
		});
  
  var request = new XMLHttpRequest();

	request.open('POST', 'https://api.kairos.com/enroll');

	request.setRequestHeader('Content-Type', 'application/json');
	request.setRequestHeader('app_id', 'db8ca6b5');
	request.setRequestHeader('app_key', 'ee5299aad61dff8cab254df485a6de2b');

	request.onreadystatechange = function () {
	if (this.readyState === 4) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);
	}
	};

var body = {
  'image': im,
  'subject_id': '1',
  'gallery_name': 'MyGallery2'
};

request.send(JSON.stringify(body));
}

function readUserData()
{
	

}

</script>
</html>
