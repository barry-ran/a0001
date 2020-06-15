//(function() {
        /* Define the number of leaves to be used in the animation */
      //  var NUMBER_OF_LEAVES = 8;

        /*
         Called when the "Falling Leaves" page is completely loaded.
         */
        function init(num,arry){
            /* Get a reference to the element that will contain the leaves */
            var container = document.getElementById('petalbox');
           // var jsontoarray = JSON.parse(arry);
            /* Fill the empty container with new leaves */
            try {
            	
            	for (var i = 0;
                     i < num;

                     i++) {
                    	container.appendChild(createALeaf(i,arry));	
                }
        
            	
//          	jsontoarray.forEach(function(value,index,arr){
//          	 container.appendChild(createALeaf(index,arr[index]['id']));	
//          	});
            }
            catch(e) {
            }
        }

        /*
         Receives the lowest and highest values of a range and
         returns a random integer that falls within that range.
         */
        function randomInteger(low, high) {
            return low + Math.floor(Math.random() * (high - low));
        }

        /*
         Receives the lowest and highest values of a range and
         returns a random float that falls within that range.
         */
        function randomFloat(low, high) {
            return low + Math.random() * (high - low);
        }

        /*
         Receives a number and returns its CSS pixel value.
         */
        function pixelValue(value) {
            return value + 'px';
        }

        /*
         Returns a duration value for the falling animation.
         */
        function durationValue(value) {
            return value + 's';
        }
        
        
        function displaydiv(){
       // 	alert(1);
        	$(".mo").css("display", "block");
					if($(".mo").show()){
						$("#petalbox").css("display","none");
		}
					$(".mo2").css("display", "block");
					if($(".mo2").show()){
						$("#petalbox").css("display","none");
		}
        	
        }

        /*
         Uses an img element to create each leaf. "Leaves.css" implements two spin
         animations for the leaves: clockwiseSpin and counterclockwiseSpinAndFlip. This
         function determines which of these spin animations should be applied to each leaf.

         */
        function createALeaf(num,id) {
            /* Start by creating a wrapper div, and an empty img element */
            var leafDiv = document.createElement('div');
            var image = document.createElement('img');
            leafDiv.className='hblist';
            //leafDiv.onclick=displaydiv();
            /* Randomly choose a leaf image and assign it to the newly created element */
            image.src ='/static/zhibo/images/hb/petal'+ randomInteger(1, 10) + '.png';
            image.setAttribute("rel",id);
            /* Position the leaf at a random location along the screen */
            leafDiv.style.top = pixelValue(randomInteger(-200, -100));
            var swidth=document.body.clientWidth-100;
           // console.log(swidth);
            leafDiv.style.left = pixelValue(randomInteger(0, swidth));

            /* Randomly choose a spin animation */
            var spinAnimationName = (Math.random() < 0.5) ? 'clockwiseSpin':'counterclockwiseSpinAndFlip';        /* Set the -webkit-animation-name property with these values */
            leafDiv.style.webkitAnimationName ='fade, drop';
            leafDiv.style.animationName ='fade, drop';
            image.style.webkitAnimationName = spinAnimationName;
            image.style.animationName = spinAnimationName;

            /* 随机下落时间 */
            var fadeAndDropDuration = durationValue(randomFloat(1.2, 8.2));

            /* 随机旋转时间 */
            var spinDuration = durationValue(randomFloat(3, 4));

            leafDiv.style.webkitAnimationDuration = fadeAndDropDuration + ', ' + fadeAndDropDuration;
            leafDiv.style.animationDuration = fadeAndDropDuration + ', ' + fadeAndDropDuration;

            // 随机delay时间
            var leafDelay = durationValue(randomFloat(0, 2));

            leafDiv.style.webkitAnimationDelay = leafDelay + ', ' + leafDelay;
            leafDiv.style.animationDelay = leafDelay + ', ' + leafDelay;
            image.style.webkitAnimationDuration = spinDuration;
            image.style.animationDuration = spinDuration;
            leafDiv.appendChild(image);
            return leafDiv;
        }
       //init(5);
   // }
//)();