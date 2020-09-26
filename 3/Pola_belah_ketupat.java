/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pola_belah_ketupat;

/**
 *
 * @author lenovoo
 */
public class Pola_belah_ketupat {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        printPattern(12);
    }
    static void printPattern(int n) 
    { 
        int i, j, spasi, k = 0; 
      
        // segitiga bagian atas
        for (i = 1; i <= n; i++) { 
      
            // cetak spasi 
            for (j = 1; j <= n - i; j++) { 
                System.out.print(" "); 
            } 
      
            
            while (k != (2 * i - 1)) { 
                if (k == 0 || k == 2 * i - 2) 
                    System.out.print("*"); 
                else
                    System.out.print(" "); 
                k++; 
            } 
            k = 0; 
      
            // baris baru
            System.out.println(); 
        } 
        n--; 
      
        // segitiga bagian bawah (terbalik)
        for (i = n; i >= 1; i--) { 
      
            // cetak spasis 
            for (j = 0; j <= n - i; j++) { 
                System.out.print(" "); 
            } 
      
           
            k = 0; 
            while (k != (2 * i - 1)) { 
                if (k == 0 || k == 2 * i - 2) 
                    System.out.print("*"); 
                else
                    System.out.print(" "); 
                k++; 
            } 
            System.out.println(); 
        } 
    } 
    
}
