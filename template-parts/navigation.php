<div id="nav_box" class="apps_single_nav">
   
</div>

<style>
	#nav_box {
    overflow-x: scroll;
    padding-left: 30px;
    margin-bottom: 50px;
    border-bottom: 1px #f0f4f5 solid;
}
#nav_box span[data-move] {
    cursor: pointer;
    text-transform: lowercase;
    margin-right: 20px;
}
#nav_box span[data-move]:hover {
	color: #0071e0;
}
</style>
<script>
	let nav_box = document.getElementById('nav_box');
	let point;
	window.addEventListener('load', function () {
	let titles = document.getElementsByTagName('h2');

	[...titles].forEach((title) => {
	nav_box.innerHTML += '<span data-move="' + title.offsetTop + '">' + title.innerText + '</span>';
	});

	var nav_links = document.querySelectorAll('[data-move]');

	nav_links.forEach(link => {
		link.addEventListener('click', function() {
		 
           point =  this.getAttribute('data-move');

           window.scrollBy({
            top: point,
            behavior: 'smooth'
        });		
		});		 
	})	
});

</script>