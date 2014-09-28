Number.prototype.mod = function(n) {
    var m = ((this%n)+n)%n;
    return m < 0 ? m + Math.abs(n) : m;
};

function Ciphers(){
	var alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];


	this.railFence = {
		crypt : function(plaintext, key){
			var key;
			var plaintext = plaintext.toLowerCase().replace(/[^a-z]/g, "");
			var encryptedText = new Array();
			
			if(plaintext.length < 1){ 
				alert("please insert a text to crypt"); 
				return; 
			}
			
			key = parseInt(key);
			
			if(key + "" == "NaN"){
				alert("key must be set and numeric"); 
				return; 
			}
			
			if (key < 1){
				alert("please insert a valid key (> 1)");
				return;
			}
			
			if(key > Math.floor(2 * (plaintext.length-1))){ 
				alert("key is too long for the plaintext length."); 
				return; 
			}  
			
			if (key == 1){
    			return plaintext;
    		}
			
			for(line=0; line < key-1; line++){
				var jump = 2 * (key-line-1);
				var j=0;
				var i=line;
				
				while (i < plaintext.length){
					encryptedText.push(plaintext.charAt(i));
					if((line==0) || (j%2 == 0)) i += jump;
					  else i+=2*(key-1) - jump;  
					  j++;          
				}
			}
			
			for(var i=line; i < plaintext.length; i+=2*(key-1)) {
				encryptedText.push(plaintext.charAt(i));
			}
			return encryptedText.join('');
		},
		
		decrypt : function(encryptedText, key){
			var key;
			var encryptedText = encryptedText.toLowerCase().replace(/[^a-z]/g, "");
			var plaintext = new Array(encryptedText.length);
			
			if(encryptedText.length < 1){ 
				alert("please insert a text to decrypt"); 
				return; 
			}
			
			key = parseInt(key);
			
			if(key + "" == "NaN"){
				alert("key must be set and numeric"); 
				return; 
			}
			
			if (key < 1){
				alert("please insert a valid key (> 1)");
				return;
			}
			
			if(key > Math.floor(2 * (encryptedText.length-1))){ 
				alert("key is too long for the encrypted text length."); 
				return; 
			}  
			
			if (key == 1){
    			return encryptedText;
    		}
			
			var k=0;
			for(line=0; line < key-1; line++){
				var jump = 2 * (key-line-1);
				var j=0;
				var i=line;
				
				while (i < encryptedText.length){
					plaintext[i] = encryptedText.charAt(k++);
					if((line==0) || (j%2 == 0)) i += jump;
					  else i += 2*(key-1) - jump;  
					  j++;          
				}
			}
			
			for(var i=line; i < encryptedText.length; i += 2*(key-1)) {
				plaintext[i] = encryptedText.charAt(k++);
			}
			return plaintext.join('');
		}
		
	},
	
	this.caesar = {
		crypt : function(plaintext, key){
			var plaintext = plaintext.toLowerCase().replace(/[^a-z]/g, "");
			
			if(plaintext.length < 1){ 
				alert("please insert a text to crypt"); 
				return; 
			}
			
			var key = parseInt(key);
			var encryptedTextArray = new Array(plaintext.length);
			
			for (var i=0; i<plaintext.length; i++){
				var index = alphabet.indexOf(plaintext.charAt(i));
				encryptedTextArray[i] = alphabet[(index + key).mod(26)]; 
			}
			return encryptedTextArray.join('');
		},
		
		decrypt : function(encryptedText, key){
			var encryptedText = encryptedText.toLowerCase().replace(/[^a-z]/g, "");
			
			if(encryptedText.length < 1){ 
				alert("please insert a text to decrypt"); 
				return; 
			}
			
			var key = parseInt(key);
			var plaintextArray = new Array(encryptedText.length);
			
			for (var i=0; i<encryptedText.length; i++){
				var index = alphabet.indexOf(encryptedText.charAt(i));
				plaintextArray[i] = alphabet[(index - key).mod(26)]; 
			}
			return plaintextArray.join('');
		}
		
	},
	
	this.vigenere = {
		crypt : function(plaintext, key){
			var encryptedText = "";
			var plaintext = plaintext.toLowerCase().replace(/[^a-z]/g, "");
			
			if(plaintext.length < 1){ 
				alert("please insert a text to crypt"); 
				return; 
			}
			
			if(key.length < 1){ 
				alert("please insert a key"); 
				return; 
			}
						
			for (var i=0; i<plaintext.length; i++){
				var positionInTheAlphabet = alphabet.indexOf(plaintext.charAt(i));
				var keyPositionInTheAlphabet = alphabet.indexOf(key.charAt(i.mod(key.length)));
				
				encryptedText += alphabet[(positionInTheAlphabet + keyPositionInTheAlphabet).mod(26)];
			}

			return encryptedText;
		}, 
		
		decrypt : function(encryptedText, key){
			var plaintext = "";
			var encryptedText = encryptedText.toLowerCase().replace(/[^a-z]/g, "");
			
			if(encryptedText.length < 1){ 
				alert("please insert a text to decrypt"); 
				return; 
			}
			
			if(key.length < 1){ 
				alert("please insert a key"); 
				return; 
			}
			
			for (var i=0; i<encryptedText.length; i++){
				var positionInTheAlphabet = alphabet.indexOf(encryptedText.charAt(i));
				var keyPositionInTheAlphabet = alphabet.indexOf(key.charAt(i.mod(key.length)));
				
				plaintext += alphabet[(positionInTheAlphabet - keyPositionInTheAlphabet).mod(26)];
			}
			return plaintext;
		}
	}
	
}

var ciphers = new Ciphers();