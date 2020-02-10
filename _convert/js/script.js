
document.getElementById('output').style.visibility = 'hidden';

document.getElementById('kmInpt').addEventListener('input', function(e) {

	document.getElementById('output').style.visibility = 'visible';
	let km = e.target.value;

	document.getElementById('mOut').innerHTML = km*1000;
	document.getElementById('smOut').innerHTML = km*100000;
	document.getElementById('mmOut').innerHTML = km*1000000;

});