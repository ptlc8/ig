<!DOCTYPE html>
<html>
	<body>
		<style>
			html, body {
				width: 100%;
				height: 100%;
			}
			img {
				width: 33%;
			}
		</style>
		<script>
			var words = [];
            window.onload = () => {
                get("liste_francais.txt").then((response) => {
                    words = response.split("\n");
                    appendImages(["canard","chaise","brique","angoisse","fleur","rouge"]);
                });
            }
			
			function appendImages(words) {
				for (let i = 0; i < words.length; i++) {
					append2Images(words[i]);
					for (let j = i+1; j < words.length; j++)
						append2Images(words[i]+' '+words[j]);
				}
			}
			
			async function append2Images(word, lang="fr") {
				let response = await get("https://pixabay.com/api/?key=15601609-0000000000000000000000000&q="+encodeURI(word)+"&image_type=photo&lang="+lang);
				response = JSON.parse(response);
				if (response.totalHits == 0) return;
				console.log(response.totalHits+" results for "+word);
				for (let i = 0; i < Math.min(2, response.totalHits); i++) {
					let img = new Image();
					img.src = response.hits[i].webformatURL;
					document.body.appendChild(img);
				}
			}
			
			async function get(url) {
				var promise = new Promise(async(resolve, reject) => {
					var xhr = new XMLHttpRequest();
					xhr.open("GET", url);
					xhr.onreadystatechange = function() {
						if (this.readyState === XMLHttpRequest.DONE && this.status === 200) resolve(xhr.responseText);
					};
					xhr.send();
				});
				return promise;
			}
		</script>
	</body>
</html>
