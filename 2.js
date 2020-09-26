// GERAKAN LURUS BERGERAK BERATURAN

// Mencari a (percepatan rata-rata)
/*
    v1 merupakan waktu awal
    v2 merupakan kecepatan akhir
    t1 merupakan waktu awal 
    t2 merupakan waktu akhir
    
    a merupakan percepatan
    a = (v2 - v1)/(t2 - t1)
*/

let v1 = 6, v2 = 15, t1 = 0, t2 = 5721;

let a = (v2 - v1)/(t2 - t1);

/* 

S = jarak (meter)
V0 = kecepatan awal sebuah benda
t = waktu 
a percepatan
t = 5721 didapatkan dari perhitungan jam 10:25:21 sampai jam 12:00:00
*/
let t = 5721;

let s = 0 * t + 1/2 * a * Math.pow(t, 2);

// s masih dalam bentuk meter

// bagi 1000 untuk menjadi kilometer
s = s / 1000;


console.log(`Jarak tempuh mobil itu adalah ${s} kilometer`);
