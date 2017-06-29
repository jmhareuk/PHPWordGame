/*
 * Title: Cipher
 * Author: James Hare
 * 
 * A class to encrypt a piece of data
 * by using a Caesar cipher.
 */
package caesarcipher;

import java.util.Scanner;

/**
 *
 * @author James Hare
 */
public class Cipher {
    
    // instance variables
    private String message;                 // a message to encrypt
    private int shift;                      // a number to shift
    private int direction;                  // a direction to shift
    private char c;                         // a character place holder
    private StringBuffer bufferMessage;     // a String that can be modified
    
    // constructor
    public Cipher() {
        
    }
    
    // methods
    /**
     * setMessage() asks the user for a String input
     *              and sets it as the message.
     */
    public void setMessage() {
        System.out.println("");
        Scanner in = new Scanner(System.in);
        System.out.print("Enter your message: ");
        message = in.nextLine();
    }
    
    /**
     * setNumber() asks the user for an int input
     *             and sets it as the shift value.
     */
    public void setShift() {
        System.out.println("");
        Scanner in = new Scanner(System.in);
        
        try {
            System.out.print("Enter the secret shift value: ");
            shift = in.nextInt();
        } catch (Exception e) {
            System.out.println("You did not enter a valid integer.");
            setShift();
        }
    }
    
    /**
     * setDirection() Asks the user for an int input
     *                to set the direction of the
     *                shift.
     */
    public void setDirection() {
        System.out.println("");
        Scanner in = new Scanner(System.in);
        
        try {
            System.out.println("Which direction does your secret shift use?");
            System.out.println("");
            System.out.println("1. Forward");
            System.out.println("2. Back");
            System.out.println("");
            System.out.print("Enter 1 or 2 indicating the direction: ");
            direction = in.nextInt();
        } catch (Exception e) {
            System.out.println("You did not enter a valid integer.");
            setDirection();
        }
    }
    
    /**
     * encipher() Encrypts the message.
     */
    public void encipher() {
        System.out.println("");
        try {
            switch (direction) {
                case 1:
                    // sets bufferMessage as a clone of message.
                    bufferMessage = new StringBuffer(message);
                    
                    // goes through every character in bufferMessage.
                    for(int i = 0; i < bufferMessage.length(); i++){
                        c = bufferMessage.charAt(i);
                        
                        // shifts the character by the shift value.
                        if(c >= 32 && c <= 126) {
                            c = (char)(c + shift);
                            
                            if(c < 32) {
                                c += 95;
                            } else if (c > 126) {
                                c -= 96;
                            }
                            bufferMessage.setCharAt(i, c);
                        }
                    }
                    
                    // prints the encrypted message.
                    System.out.print("Your message is: ");
                    System.out.println(bufferMessage);
                    break;
                case 2:
                    // sets bufferMessage as a clone of message.
                    bufferMessage = new StringBuffer(message);
                    
                    // goes through every character in bufferMessage.
                    for(int i = 0; i < bufferMessage.length(); i++) {
                        c = bufferMessage.charAt(i);
                        
                        // shifts the character by the negative shift value.
                        if(c >= 32 && c <= 126) {
                            c = (char)(c + -shift);
                            
                            if(c < 32) {
                                c += 95;
                            } else if (c > 126) {
                                c -= 96;
                            }
                            bufferMessage.setCharAt(i, c);
                        }
                    }
                    
                    // prints the encrypted message.
                    System.out.print("You message is: ");
                    System.out.println(bufferMessage);
                    break;
                default:
                    System.out.println("You have not yet set the direction.");
                    break;
            }
        } catch (Exception e) {
            System.out.println("Some aspects need to be set before attempting encryption.");
        }
        
    }
    
    /**
     * decipher() Decrypts the message.
     */
    public void decipher() {
        System.out.println("");
        try {
            switch (direction) {
                case 1:
                    // sets bufferMessage as a clone of message.
                    bufferMessage = new StringBuffer(message);
                    
                    // goes through every character in bufferMessage.
                    for(int i = 0; i < bufferMessage.length(); i++){
                        c = bufferMessage.charAt(i);
                        
                        /**
                         * Shifts the character by the negative shift
                         * value. This is based on the way that the
                         * message was originally encrypted.
                         */
                        if(c >= 32 && c <= 126) {
                            c = (char)(c + -shift);
                            
                            if(c < 32) {
                                c += 95;
                            } else if (c > 126) {
                                c -= 96;
                            }
                            bufferMessage.setCharAt(i, c);
                        }
                    }
                    
                    // prints the decrypted message.
                    System.out.print("Your message is: ");
                    System.out.println(bufferMessage);
                    break;
                case 2:
                    // sets bufferMessage as a clone of message.
                    bufferMessage = new StringBuffer(message);
                    
                    // goes through every character in bufferMessage.
                    for(int i = 0; i < bufferMessage.length(); i++) {
                        c = bufferMessage.charAt(i);
                        
                        /**
                         * Shifts the character by the shift
                         * value. This is based on the way that the
                         * message was originally encrypted.
                         */
                        if(c >= 32 && c <= 126) {
                            c = (char)(c + shift);
                            
                            if(c < 32) {
                                c += 95;
                            } else if (c > 126) {
                                c -= 96;
                            }
                            bufferMessage.setCharAt(i, c);
                        }
                    }
                    
                    // prints the decrypted message.
                    System.out.print("You message is: ");
                    System.out.println(bufferMessage);
                    break;
                default:
                    System.out.println("You have not yet set the direction.");
                    break;
            }
        } catch (Exception e) {
            System.out.println("Some aspects need to be set before attempting encryption.");
        }
        
    }
    
}
