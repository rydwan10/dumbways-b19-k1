const readline = require("readline");

function convertStringToBinary(string) {
    let convertedString = '';
    splittedString = string.split('');

    splittedString.forEach(element => {
        convertedString += element.charCodeAt(0).toString(2) + " ";
    });
    
    return convertedString;
}


const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

rl.question("Masukkan kata atau kalimat: ", function(string) {
    console.log(`Kata atau kalimat Anda : ${string}`);
    console.log(`Kata atau kalimat dalam biner: ${convertStringToBinary(string)}`);
    rl.close();
});

rl.on("close", function() {
    process.exit(0);
});

// convertStringToBinary('dumbways');
