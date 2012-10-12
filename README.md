Pledge-Starter
==============

An open source Kickstarter clone for running your own Kickstarter projects built in PHP using the Codeigniter Framework.

## READ THIS FIRST
This is far from complete. The idea is to create a simple Kickstarter clone in PHP that offers simple functionality and allows people to pledge donations to your projects. You can have tiers (if you want) but can only run one project at a time. This isn't meant to be a complete clone, just the functionality so you can crowd-fund your own ideas without having to give similar sites commission.

## How to Install
Pledge Starter uses Codeigniter Migrations which means any updates made to the database are autonomous. Simply create a MySQL database called, "pledgestarter" and then run: http://localhost/pledgestarter/App/migrate — to automatically set the database up with everything we need. If you choose a different name for your database, don't forge to update App/application/config/database.php