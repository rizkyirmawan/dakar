// Disable Readonly Select
$("#bagian-select").css("pointer-events","none");

// Live Clock
let timeDisplay = document.getElementById("time");

function refreshTime() {
  let d = new Date();
  let s = d.getSeconds();
  let m = d.getMinutes();
  let h = d.getHours();
  timeDisplay.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}

if (timeDisplay) {
	setInterval(refreshTime, 1000);
}

let inputRupiah = document.querySelectorAll('#input-rupiah');

if (inputRupiah) {
  inputRupiah.forEach((el) => {
    el.addEventListener('keyup', function() {
      el.value = formatRupiah(this.value, 'Rp. ');
    });
  });
}

// Numbers Only Input
function isNumber(evt) {
  var theEvent = evt || window.event;

  // Handle Paste
  if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
  } else {
    // Handle Keypress
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

// Format Rupiah
function formatRupiah(angka, prefix){
  var numberString = angka.replace(/[^,\d]/g, '').toString(),
  split   = numberString.split(','),
  sisa    = split[0].length % 3,
  rupiah  = split[0].substr(0, sisa),
  ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

  if(ribuan){
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}