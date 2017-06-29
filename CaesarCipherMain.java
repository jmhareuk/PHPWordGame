/*
 * Title: Caesar Cipher
 * Author: James Hare
 * 
 * A simple Caesar cipher for the purpose of
 * demonstration for Students of Information Security.
 */
package caesarcipher;

import java.util.Scanner;

/**
 *
 * @author James Hare
 */
public class CaesarCipherMain {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        System.out.println("**********************************");
        System.out.println("**                              **");
        System.out.println("**          Welcome to          **");
        System.out.println("**       the Caesar Cipher      **");
        System.out.println("**                              **");
        System.out.println("**********************************");
        
        startProgram();     // calls the startProgram() method.

    }
    
    public static void startProgram() {
        
        Scanner in = new Scanner(System.in);    // a new Scanner
        
        System.out.println(" ");
        System.out.println("What would you like to do?");
        System.out.println(" ");
        System.out.println("1. Encrypt a message");
        System.out.println("2. Decrypt a message");
        System.out.println("3. Quit");
        System.out.println(" ");
        System.out.print("Enter a number to select (1-3): ");
        
        try {
            
            int selection = in.nextInt();   // asks the user for an int
            
            switch(selection) {
                case 1:
                    // Encrypts a message
                    Cipher encrypted = new Cipher();
                    encrypted.setMessage();
                    encrypted.setDirection();
                    encrypted.setShift();
                    encrypted.encipher();
                    break;
                case 2:
                    // Decrypts a message
                    Cipher decrypted = new Cipher();
                    decrypted.setMessage();
                    decrypted.setDirection();
                    decrypted.setShift();
                    decrypted.decipher();
                    break;
                case 3:
                    System.exit(0);     // Safely terminates the program
                    break;
                case 4:
                    // Uses a brute-force attack to crack an encrypted message
                    Brutus hack = new Brutus();
                    hack.welcomeText();
                    hack.setMessage();
                    hack.crackTheMessage(0, 10);  // attempts shifts in increments of 10
                    break;
                default:
                    System.out.println("You have entered an invalid number. Please try again.");
            }
            startProgram();     // Uses recursion to recall the method until program is terminated
            
        } catch (Exception e) {
            System.out.println("You did not enter a valid number.");
            startProgram();
        }
        
    }
    
}
