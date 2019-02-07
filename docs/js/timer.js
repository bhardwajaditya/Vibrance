const countdown = document.querySelector('#countdown');

// Set launch date
const launchDate = new Date('Feb 21, 2019 10:00:00').getTime();

// Update every second
const intv1 = setInterval(function(){
  // Get todays date and time ms
  const now = new Date().getTime();
  
  // Distance from now to launch date
  const distance = launchDate - now;
  
  // Time calculations
  const days = Math.floor(distance / (1000* 60 * 60 * 24));
  const hours = Math.floor((distance % (1000* 60 * 60 * 24)) / (1000 * 60 * 60));
  const mins = Math.floor((distance % (1000* 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000* 60)) / 1000);
  
  // Display result
  countdown.innerHTML = `
<div>${days}<span> Days</span></div>
<div>${hours}<span> Hours</span></div>
<div>${mins}<span> Mins</span></div>
<div>${seconds}<span> Secs</span></div>
`;
  
 // If launch date passed
  if(distance < 0){
     // Stop countdown
    clearInterval(intv1);
    // Style and output text
    countdown.style.color='red';
    countdown.innerHTML = "Launched!"
     }
  
}, 1000);