Steps for installing software on your desktop:

1. Begin by downloading XAMPP from the official website: https://www.apachefriends.org/download.html. Choose the appropriate version for your Windows system and follow these installation steps:

a. Download the XAMPP installer.
b. Run the .exe file.
c. Temporarily disable any antivirus software.
d. Deactivate User Account Control (UAC).
e. Start the setup wizard.
f. Choose the necessary software components.
g. Specify the installation directory.
h. Initiate the installation process.

If needed, refer to this link for additional assistance: https://www.ionos.ca/digitalguide/server/tools/xampp-tutorial-create-your-own-local-test-server/.

Open the XAMPP control panel and start both Apache and MySQL.

2. Access localhost/phpmyadmin in the Chrome browser. Click on the "Database" link and create a new database named "kijiji."

3. Navigate to the directory where XAMPP is installed and open the "htdocs" folder under the XAMPP directory.

4. Open Command Prompt on your PC and navigate to the path "Drivename/xampp/htdocs" in CMD.

5. Execute the command git clone https://github.com/torontoSiteMaster/kijijiFatcher.git in CMD. Provide authorization when prompted, and this will download all project files into a folder.

6. A folder named "kijijiFatcher" will now be available in the "htdocs" folder.

7. Select the project folder by typing cd kijijiFatcher in CMD under "Drivename/xampp/htdocs."

8. Verify if Composer is installed by typing the command composer. If not installed, download and install it from https://getcomposer.org/download/. Refer to the installation guide at https://www.ionos.ca/digitalguide/server/configuration/php-composer-installation-on-windows-10/.

9. Change the name of the env.example file to .env and update the value of DB_DATABASE with the database name created in step 2.

10. Run the command php artisan key:generate to generate a key in the project folder.

11. Execute the command php artisan migrate to import all data tables into the database.

12. Finally, run the command php artisan serve to start the project. Keep the CMD window open.

13. Access the project at the provided link http://127.0.0.1:8000/.

14. Use the credentials "test@email.com" and "123456" to log in.

15. Before proceeding further, install Tampermonkey in Chrome from https://chromewebstore.google.com/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo. After installation, pin it to the URL bar and click on it. Open the dashboard, click on the "+" sign, and add scripts from the "tampermonkey_script" folder in the project directory to the browser.