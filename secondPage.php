	<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
	<head>
		<title> <!-- title of the page -->
			LEVEL 2
		</title>
		<style type="text/css">
			canvas{
				background-color: #F1F1F1;
				border:1px solid #D3D3D3;
			}
			audio{
				display: none;
			}
		</style>
	</head>
	<body onload="startGame()"> <!--starting game on loading of web page -->
	<script type="text/javascript">
	var myGameArea;
	var obstacles;
	var i,p,enemy_1,enemy_2,k1,k2,pu1;
	var img,imgData,l,food1,food2,pu2;
	var door,coin1,coin2,coin3,coin4,pu3;
	var time,m,a,b,c,d;
	var num=90;
	var s=50;
	var s1=50;
	var myScore,score,myHealth,crash;
	var health=160;
	function startGame()
		{
			crash=document.getElementById("crash"); //declaring variable for crash sound
			myGameArea.start();//calling to start game
		}
		myGameArea=
		{
			canvas:document.createElement("canvas"),
			start:function()
			{   
				k1=0;
				k2=0;
				score=0;
				l=0;
				m=0;
				a=0;
				b=0;
				c=0;
				d=0;
				this.canvas.width=1000; 
				this.canvas.height=1000;
				this.context=this.canvas.getContext("2d");
				img=new Image();
	         	img.src="dungeon_2.png";
	         	coin1=new component(this.context,30,30,"coin.png",105,100,"image");
	         	coin2=new component(this.context,30,30,"coin.png",390,288,"image");
	         	coin3=new component(this.context,30,30,"coin.png",580,850,"image");
	         	coin4=new component(this.context,30,30,"coin.png",765,575,"image");
	         	arrow_l1=new component(this.context,20,20,"arrow_left.png",350,400,"image");
	         	arrow_r1=new component(this.context,20,20,"arrow_right.png",280,400,"image");
	            arrow_l2=new component(this.context,20,20,"arrow_left.png",550,676,"image");
	         	arrow_r2=new component(this.context,20,20,"arrow_right.png",875,676,"image");
	           	myGamePiece=new component(this.context,30,30,"pacman_stop.jpg",102,865,"image");
	            door=new component(this.context,50,50,"door.jpg",857,95,"image");
	            enemy_1=new component(this.context,30,30,"enemy_1.jpg",350,400,"image");
	            enemy_2=new component(this.context,30,30,"enemy_2.png",900,690,"image");
	            time=new component(this.context,"20px","consolas","red",750,50,"text1");
	            myScore=new component(this.context,"20px","consolas","red",150,50,"text2");
	            myHealth=new component(this.context,"20px","consolas","red",450,50,"text3");
	            food1=new component(this.context,30,30,"food_1.png",578,365,"image");
	            food2=new component(this.context,30,30,"food_2.jpg",102,500,"image");
	            pu1=new component(this.context,30,30,"powerup_1.png",375,100,"image");
	            pu2=new component(this.context,30,30,"powerup_2.gif",300,750,"image");
	            pu3=new component(this.context,30,30,"powerup_3.jpg",390,500,"image");
				document.body.insertBefore(this.canvas,document.body.childNodes[0]);
				this.interval=setInterval(updateGameArea,20); //setting interval for 20 ms
			    setTimeout(function(){clearInterval(this.interval);alert("Game over!");document.location.reload();},60000);
				window.addEventListener("keydown",function(e) //checking for keyboard press
				{
					myGameArea.key=e.keyCode;
				})
				window.addEventListener("keyup",function(e)
				{
					myGamePiece.image.src="pacman_stop.jpg";
					myGameArea.key=false;

				})
			},
			clear:function() 
			{
				this.context.clearRect(0,0,this.canvas.width,this.canvas.height);
				this.context.drawImage(img,0,0);
			},
			stop:function()
			{
				clearInterval(this.interval);
			}
		}
		function component(context,width,height,image,x,y,type)//creating game pieces
		{
			this.type=type;
			this.width=width;
			this.height=height;
			this.image=image;
			this.speedX=0;
		    this.speedY=0;
		if(this.type=="image")//checking if input type is image
			{
			this.image=new Image();
			this.image.src=image;
		}
			this.x=x;
			this.y=y;
			this.update=function()//update function
			{
		if(this.type=="image")
				{
				ctx=context;
	            ctx.drawImage(this.image,this.x,this.y,this.width,this.height);
	        }
	        if(this.type=="text1")
	        {
	       	ctx=context;
	    	ctx.font="20px consolas";
	    	ctx.fillStyle="red";
	    	ctx.fillText(this.text,this.x,this.y);
	    	s=s-1;
	    	if(s==0)
	    	{
	   			 s=50;
	    		 num=num-1;
	    	}
	        }
	        if(this.type=="text2")
	        {
	        if(l==1)
	        {
	            score=score+25;
	        	l=0;
	        	m=1;
	        }
	        ctx=context;
	    	ctx.font="20px consolas";
	    	ctx.fillStyle="red";
	    	ctx.fillText(this.text,this.x,this.y);
		    	}
		    	if(this.type=="text3")
		    	{
		    	  s1=s1-1;//keeping a count of 1 second
		    		if(s1==0)
		    		{

		    			s1=50;
		    			health=health-2;//decreasing health
		    			 if(health==0)
		    			 {
		    				alert("Oopsss...Your hero is dead tired...");
		    				document.location.reload();//reloading game
		    			 }
		    		}
		    		if(a==1)
		    		{
		    			health=health+5;//checking if food has been obtained
		    			a=0;
		    			b=1;
		    		}
		    ctx=context;
	    	ctx.font="20px consolas";
	    	ctx.fillStyle="red";
	    	ctx.fillText(this.text,this.x,this.y);
		    	}
			}
			this.newpos=function()
			{
				this.x+=this.speedX;//increasing x speed of piece
				this.y+=this.speedY;//increasing y speed of piece
			}
		this.color=function()
			{
		   	  if(p==37||p==38)
	            imgData=ctx.getImageData(this.x,this.y,1,1).data;//obtaining color of x and y coordinates of left corner
	          else
	          	imgData=ctx.getImageData(this.x+30,this.y+30,1,1).data;//obtaining color of x and y coordinates of right corner
	          return imgData;
	          		}
			this.crashWith=function()
			{
	            if(this.color()!="0,0,0,255")
	            	return true;
			}
			this.crashWithDoor=function(otherobj)
			{
				var myLeft=this.x;
				var myRight=this.x+this.width;
				var myTop=this.y;
				var myBottom=this.y+this.height;
				var otherLeft=otherobj.x;
				var otherRight=otherobj.x+otherobj.width;
				var otherTop=otherobj.y;
				var otherBottom=otherobj.y+otherobj.height;
				var crash =true;
				if((myLeft>otherRight)||(myRight<otherLeft)||(myTop>otherBottom)||(myBottom<otherTop))
					crash=false;
				return crash;
			}
		}
		function updateGameArea()
		{
		    myGameArea.clear();
			myGamePiece.speedX=0;
			myGamePiece.speedY=0;
			if(myGamePiece.crashWithDoor(arrow_l1))//checking for crash with arrow sent by enemy 1
			{
				crash.play();
				if(d==1)
			{
				arrow_l1.image.src="";
				d=0;
			}
			else
			{
				myGamePiece.x=78;
				myGamePiece.y=550;
			}
			}
			if(myGamePiece.crashWithDoor(arrow_r1))//checking for crash with arrow sent by enemy 1
			{
				crash.play();
				if(d==1)
			{
				arrow_l1.image.src="";
				d=0;
			}
			else
			{
				myGamePiece.x=78;
				myGamePiece.y=550;
			}
			}
			if(myGamePiece.crashWithDoor(arrow_l2))//checking for crash with arrow sent by enemy 2
			{
				crash.play();
				if(d==1)
			{
				arrow_l1.image.src="";
				d=0;
			}
			else
			{
				myGamePiece.x=78;
				myGamePiece.y=100;
			}
			}
			if(myGamePiece.crashWithDoor(arrow_r2))//checking for crash with arrow sent by enemy 2
			{
				crash.play();
				if(d==1)
			{
				arrow_l1.image.src="";
				d=0;
			}
			else
			{
				myGamePiece.x=78;
				myGamePiece.y=100;
			}
			}
			if(myGamePiece.crashWithDoor(food1))//checking if food is obtained
			{
				crash.play();
				if(b==0)
					a=1;
				food1.image.src="";
			}
			if(myGamePiece.crashWithDoor(food2))//checking if food is obtained
			{
				crash.play();
				if(b==0)
					a=1;
				food2.image.src="";
			}
			if(myGamePiece.crashWithDoor(coin1))//checking for coin collection
			{ 
				crash.play();
				if(m==0)
	               l=1;
	            coin1.image.src="";
			}
			if(myGamePiece.crashWithDoor(coin2))//checking for coin collection
		   {	
		   	   crash.play();
				if(m==0)
	               l=1;
	            coin2.image.src="";
				}
			if(myGamePiece.crashWithDoor(coin3))//checking for coin collection
			{
				crash.play();
				if(m==0)
	               l=1;
	            coin3.image.src="";
			}
			if(myGamePiece.crashWithDoor(coin4))//checking for coin collection
			{
				crash.play();
				if(m==0)
	               l=1;
	            coin4.image.src="";
			}
			if(myGamePiece.crashWithDoor(pu1))//checking for collision with first powerup
			{
				crash.play();
				c=1;
			}
			if(myGamePiece.crashWithDoor(pu2))//checking for collision with second powerup
			{
				crash.play();
                d=1;
                pu2.image.src="";
			}
			if(myGamePiece.crashWithDoor(pu3))//checking for collision with third powerup
			{
				crash.play();
				d=1;
				pu3.image.src="";
			}
			if(myGamePiece.crashWithDoor(door))//checking for collision with door
			{
				crash.play();
				alert("CONGRATULATIONS!!! Level 2 cleared!!! You have escaped the dungeon");
			}
			if(myGamePiece.crashWithDoor(enemy_1))//checking for collision with enemy 1
			{
			  crash.play();
			   if(d==1)
			   {
			   	enemy_1.image.src="";
			   	arrow_l1.image.src="";
			   	arrow_r1.image.src="";
			   }
			   else
			   {
	           alert("Sorry!!!You must restart");
	           document.location.reload();
	           }
		     }
		     if(myGamePiece.crashWithDoor(enemy_2))//checking for collision with enemy 2
			{
               crash.play();
			   if(d==1)
			   {
			   	enemy_2.image.src="";
			   	arrow_l2.image.src="";
			   	arrow_r2.image.src="";
			   }
			   else
			   {
	           alert("Sorry!!!You must restart");
	           document.location.reload();
	           }
			}
			if(myGameArea.key&&myGameArea.key==38)//up arrow pressed
			{
				myGamePiece.image.src="pacman_up.jpg";
				if(c==1)
					myGamePiece.speedY=-4;
				else
				    myGamePiece.speedY=-2;
				myGamePiece.speedX=0;
				p=38;
			if(myGamePiece.crashWith())
				{
					crash.play();
					myGamePiece.image.src="pacman_stop.jpg";
					if(c==1)
					myGamePiece.speedY+=4;
				else
					myGamePiece.speedY+=2;
				myGamePiece.speedX=0;
				}
			}
			if(myGameArea.key&&myGameArea.key==37)//left arrow pressed
			{
				myGamePiece.image.src="pacman_left.png";
				if(c==1)
					myGamePiece.speedX=-4;
				else
				    myGamePiece.speedX=-2;
				myGamePiece.speedY=0;
				p=37;
				if(myGamePiece.crashWith())
				{ 
					crash.play();
					myGamePiece.image.src="pacman_stop.jpg";
					if(c==1)
					myGamePiece.speedX+=4;
				else
					myGamePiece.speedX+=2;
				myGamePiece.speedY=0;
				}
			}
			if(myGameArea.key&&myGameArea.key==39)//right arrow pressed
			{
				myGamePiece.image.src="pacman_right.jpg";
				if(c==1)
					myGamePiece.speedX=4;
				else
				    myGamePiece.speedX=2;
				myGamePiece.speedY=0;
				p=39;
				if(myGamePiece.crashWith())
				{
					crash.play();
					myGamePiece.image.src="pacman_stop.jpg";
					if(c==1)
					myGamePiece.speedX-=4;
				else
					myGamePiece.speedX-=2;
			    myGamePiece.speedY=0;
				}
			}
			if(myGameArea.key&&myGameArea.key==40)//down arrow pressed
			{
				myGamePiece.image.src="pacman_down.png";
				if(c==1)
					myGamePiece.speedY=4;
				else
				    myGamePiece.speedY=2;
				    myGamePiece.speedX=0;
				p=40;
				if(myGamePiece.crashWith())
				{  
					crash.play();
					myGamePiece.image.src="pacman_stop.jpg";
					if(c==1)
					myGamePiece.speedY-=4;
				else
					myGamePiece.speedY-=2;
					myGamePiece.speedX=0;
				}
			}
	     myGamePiece.newpos();
	     myGamePiece.update();
	     door.update();
    if(enemy_2.x<=550)
     	k2=1;
    if(enemy_1.x<=280)
	    k1=1;
	if(k1==0)
	    enemy_1.speedX=-1;
	if(k2==0)
	    enemy_2.speedX=-2;
	if(enemy_1.x>350)
	 	k1=0;
	if(enemy_2.x>900)
	 	k2=0;
	if(k1==1)
	    enemy_1.speedX=1;
	if(k2==1)
	     enemy_2.speedX=2;
	     enemy_1.speedY=0;
	     enemy_2.speedY=0;
	     enemy_1.newpos();
	     enemy_2.newpos();
	     enemy_1.update();
	     enemy_2.update();
	     if(k2==1)
	     {
	    	arrow_r2.x=875;
	    	arrow_r2.y=690;
	    	arrow_l2.speedY=0;
	    	arrow_l2.speedX=3;
	     	arrow_l2.newpos();
	        arrow_l2.update();
	     }
	     if(k2==0)
	     {
	   	    arrow_l2.x=550;
	        arrow_l2.y=690;
	    	arrow_r2.speedX=-3;
	    	arrow_r2.speedY=0;
	    	arrow_r2.newpos();
	        arrow_r2.update();
	     }
	     if(k1==1)
	     {
	     	arrow_r1.x=400;
	     	arrow_r1.y=400;
	     	arrow_l1.speedY=0;
	     	arrow_l1.speedX=5;
	     	arrow_l1.newpos();
	        arrow_l1.update();
	     }
	         if(k1==0)
	     {
	     	arrow_l1.x=280;
	        arrow_l1.y=400;
	     	arrow_r1.speedX=-5;
	     	arrow_r1.speedY=0;
	     	arrow_r1.newpos();
	        arrow_r1.update();
	     }
	     coin1.update();
	     coin2.update();
	     coin3.update();
	     coin4.update();
	     time.text="Time left-"+num+"seconds";//updating time
	     time.update(); 
	     myScore.text="Score:"+score;//updating score
	     myScore.update();
	     myHealth.text="My Health-"+health;//updating health
	     myHealth.update();
	     food1.update();
	     food2.update();
	     pu1.update();
	     pu2.update();
	     pu3.update();
		}
	</script>
	<audio controls autoplay id="audio">
	<source src="music.mp3" type="audio/mpeg">
	</audio>
	<audio controls id="crash">
	<source src="crash.mp3" type="audio/mpeg">	
	</audio>
	</body>
	</html>