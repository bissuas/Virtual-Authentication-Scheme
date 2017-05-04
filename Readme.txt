Requirements
1. XAMPP for creating a PHP Development Environment.XAMPP is an easy to install
   Apache distribution containing MySQL, PHP and Perl.
2. Browsing Tools like Mozilla Firefox, Chrome, Safari etc.

Steps
1. Install XAMPP
2. Install browsing tools
3. After XAMPP installation, run XAMPP control panel.
4. Enter http://localhost/xampp/ in a browser URL area. If the XAMPP homepage
   comes up, then everything is going as required.
5. Now, add login at the end of url which looks like http://localhost/xampp/login/
6. Now, click on Login, the system runs.

Now, follow the registration and login steps as described below shown with an example.

Let us suppose, ram is a user and created an account. His details are as follows:
a.	first name : ram
b.	last name  : mohan
c. 	email      : ram_mohan@hotmail.com
d.	Secret string: ra
e.	Secret function : 1 from following 3 options
	1.	+ , - , *
	2.	- , + , *
	3.	* , -, + 

f.	Secret password : 134
g.	Pass Pattern: X1, X5, X9 from the following 3 by 3 array
	X1 X2 X3
	X4 X5 X6
	X7 X8 X9



Now, for authentication, ram inputs his email and submits to the system.
System checks whether user exists or not. If user exists, following action takes place.

i.	3 by 3 array type value is shown in the screen as follows:
	2  3  4
	5  7  9
	1  6  8
As, user has previously selected X1, X5 and X9 as password locations, 2, 7 and 8 will be
his system generated pass value, which he will use for calculation.

ii.	Now, user will use the previously selected function 1 i.e. +, - and * to calculate password.
	Let us calculate,
	Here, Secret password = 134
      	      Secret function = 1
      	      System generated value = 2, 7 and 8
	Then, the user password will be 
	      1+ 2 = 3
	      3-7 = 4
	      4*8 = 32
		= 3432
iii.	The final part is to add user secret string with calculated value, which is our virtual password. So, in this case our virtual password will be
	ra + 3432 = ra3432.

Using the given password user can login the system.

