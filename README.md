## Negotiation App

In this project there is a command that will prompt you to evaluate 
3 computers and give a score based on the technical and price criterion

The app chooses the best proposal and displays it 

Steps to run:

    1) copy .env.local content to your .env file
    2) composer install
    3) run command - bin/console proposal:negotiate
    
### Example

 * `Dell - i7, Quadcore 2,3 GHz, full HD, 16 Gb RAM, energy star 100 certified - 2500 €`
 * `Lenovo - i5, Quadcore 2,2 GHz, full HD, 8 GB RAM, energy star 100 certified- 2300 €`
 * `Asus - i7, Quadcore 2,1 GHz, Ultra HD, 8 GB RAM, energy star 80 certified- 2000 €`

    Choose pc to evaluate:
     [0] Dell
     [1] Lenovo
     [2] Asus
    > 0
   
    What is the pc price?:
    > 2500
   
    Set scores for processor, screen, ram, certified:
    > 5,3,5,5
   
    Choose pc to evaluate:
     [0] Dell
     [1] Lenovo
     [2] Asus
    > 1
   
    What is the pc price?:
    > 2300
   
    Set scores for processor, screen, ram, certified:
    > 2,3,4,5
   
    Choose pc to evaluate:
     [0] Dell
     [1] Lenovo
     [2] Asus
    > 2
   
    What is the pc price?:
    > 2000
   
    Set scores for processor, screen, ram, certified:
    > 5,5,3,3
   
                                                                                                                           
   [OK] The preferred proposal is Asus  with a score 270  
