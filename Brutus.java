/*
 * Title: Brutus
 * Author: James Hare
 * 
 * A class that can be used in a brute-force
 * attack to discover a message encrypted by
 * the Cipher class.
 */
package caesarcipher;

import java.util.Scanner;

/**
 *
 * @author James Hare
 */
public class Brutus {
    
    // instance variables
    private String message;                        // encryptd text
    private char c;                                // a character place holder
    private StringBuffer bufferMessage;            // a String that can be modified
    private Scanner in = new Scanner(System.in);   // a new scanner
    private int selection;                         // an int to represent a selection
    
    // constructor
    public Brutus() {
        
    }
    
    // methods
    /**
     * setMessage() asks the user for a String input
     *              and sets it as the message.
     */
    public void setMessage() {
        System.out.println("");
        System.out.print("Enter your message: ");
        message = in.nextLine();
    }
    
    /**
     * crackTheMessage() allows the attacker to attempt
     *                   to crack the original message.
     * @param min a minimum shift value to try.
     * @param max a maximum shift value to try.
     */
    public void crackTheMessage(int min, int max) {
        
        // tries every possible forward shift between the min and max shifts.
        for(int x = min; x < max; x++) {
            // sets bufferMessage as a clone of message.
            bufferMessage = new StringBuffer(message);
            
            // goes through every character in bufferMessage.
            for(int i = 0; i < bufferMessage.length(); i++){
                c = bufferMessage.charAt(i);
                
                // shifts the character by the shift value.
                if(c >= 32 && c <= 126) {
                    c = (char)(c + x);
                    
                    if(c < 32) {
                        c += 95;
                    } else if (c > 126) {
                        c -= 96;
                    }
                    bufferMessage.setCharAt(i, c);
                }
            }
            
            // prints the possible message
            System.out.print("Possible message is: ");
            System.out.println(bufferMessage);
        }
        
        // tries every possible backwards shift between the min and max shifts.
        for(int x = min; x < max; x++) {
            // sets bufferMessage as a clone of message.
            bufferMessage = new StringBuffer(message);
            
            // goes through every character in bufferMessage.
            for(int i = 0; i < bufferMessage.length(); i++){
                c = bufferMessage.charAt(i);
                
                // shifts the character by the shift value.
                if(c >= 32 && c <= 126) {
                    c = (char)(c + -x);
                    
                    if(c < 32) {
                        c += 95;
                    } else if (c > 126) {
                        c -= 96;
                    }
                    bufferMessage.setCharAt(i, c);
                }
            }
            
            // prints the possible message
            System.out.print("Possible message is: ");
            System.out.println(bufferMessage);
        }
        
        // Gives the user the option to try again.
        System.out.println("");
        System.out.print("Do you want to continue cracking? (enter '1' for yes or '2' for no): ");
        selection = in.nextInt();
        System.out.println("");
        
        try {
            switch (selection) {
                case 1:
                    crackTheMessage(min-10, max-10); // moves onto the next set of 10 shifts
                    break;
                case 2:
                    // exits the method
                    break;
                default:
                    System.out.println("You did not make a valid selection.");
                    break;
            }
        } catch (Exception e) {
            System.out.println("You did not enter a valid number. Please try again.");
            System.out.println("");
            crackTheMessage(min, max);    // uses recursion to recall the method
        }
    }
    
    /**
     * welcomeText() prints out a welcome message and
     *               instructions to the attacker after
     *               they initiate the launch of Hacker
     *               Mode.
     */
    public void welcomeText() {
        System.out.println("");
        System.out.println("***************************************************");
        System.out.println("*                                                 *");
        System.out.println("*             !!    Hacker Mode    !!             *");
        System.out.println("*                     Enabled                     *");
        System.out.println("*                                                 *");
        System.out.println("*                     ______                      *");
        System.out.println("*                  .-\"      \"-.                   *");
        System.out.println("*                 /            \\                  *");
        System.out.println("*                |              |                 *");
        System.out.println("*                |,  .-.  .-.  ,|                 *");
        System.out.println("*                | )(__/  \\__)( |                 *");
        System.out.println("*                |/     /\\     \\|                 *");
        System.out.println("*                (_     ^^     _)                 *");
        System.out.println("*                 \\__|IIIIII|__/                  *");
        System.out.println("*                  | \\IIIIII/ |                   *");
        System.out.println("*                  \\          /                   *");
        System.out.println("*                   `--------`                    *");
        System.out.println("*                                                 *");
        System.out.println("*                                                 *");
        System.out.println("***************************************************");
        System.out.println("");
        System.out.println("Instructions: Hacker Mode allows an attacker");
        System.out.println("              to discover your message by using");
        System.out.println("              a brute-force attack.");
        System.out.println("");
        System.out.println("              Begin by entering the text that you");
        System.out.println("              want to crack.");
        System.out.println("");
        System.out.println("              The program will then attempt to crack");
        System.out.println("              the text in increments of 10 shifts, both");
        System.out.println("              positive and negative, out from zero every");
        System.out.println("              time you enter a 1.");
        System.out.println("");
        System.out.println("              To quit the cracker, enter a 2.");
        System.out.println("");
        System.out.println("              Although the program will not highlight");
        System.out.println("              the cracked message, the user will be");
        System.out.println("              able to identify the original message in");
        System.out.println("              plaintext.");
    }
    
}
