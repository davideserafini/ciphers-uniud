## What is this
This is the source files of http://ciphersuniud.davideserafini.com, a small website developed as an educational project for the course of "Security of Multimedia Application" at University of Udine in 2014. The main purpose is to show in a very simple way how crypt and decrypt works in 5 different ciphers:
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
Project is built using [CodeIgniter](https://ellislab.com/codeigniter), using the MVC approach and leveraging several security features offered by the framework.
Project also uses [phpseclib](http://phpseclib.sourceforge.net) for the implementation of AES and RSA.

CodeIgniter and phpseclib are not included in this repository, please download them from the authors' sites. Place the library to application/libraries/ renaming the directory to phpseclib.

You also have to specify your own database data in application/config/database.php

## Notes
The code is not heavily optimized because this is not the purpose of the project.
Https is not supported for a simple matter of costs of SSL certificates for a simple educational project.