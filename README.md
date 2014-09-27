## What is this
This small website has been created as an educational project for the course of "Security of Multimedia Application" at University of Udine in 2014. The main purpose is to show in a very simple way how crypt and decrypt works in 5 different ciphers:
- Rail Fence
- Caesar
- Vigenère
- AES
- RSA

The second purpose is to implement the site to be secure, also following these prerequisites:
- site can be accessed only after logging in
- account datas must be saved in a database
- password must be stored hashed
- personal account page to edit personal info must be present
- login/logout must be handled using sessions and cookies

## Technical info
Project is built using [CodeIgniter]{https://ellislab.com/codeigniter} and page templates for the UI, using the MVC approach and leveraging several security features offered by the framework.
Project also uses [phpseclib]{http://phpseclib.sourceforge.net/} for the implementation of AES and RSA.


## Notes
The code is not heavily optimized because this is not the purpose of the project.
Https is not supported for a simple matter of costs of SSL certificates for a simple educational project.