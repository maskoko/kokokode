<?php
  /**
   * Language File
   *
   * @package SIM TEDC
   * @author a2ng
   * @copyright 2012
   * @version $Id: language.php, v1.00 2012-01-10 10:11:25 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php

  //add your locale settings here
  function lang($phrase)
  {
      static $lang = array(
			/* == Global == */
			'YES' => 'Yes',
			'NO' => 'No',
			'ADD' => 'Tambah',
			'EDIT' => 'Edit',
			'DELETE' => 'Delete',
			'VIEW' => 'View',
			'UPDATE' => 'Update',
			'SAVE' => 'Save',
			'SELECT' => '-- Pilih --',
			'SELECT_ALL' => '-- Semua --',
			'DETAILS' => 'Details',
			'NO_DATA' => 'Tidak ada data.',
	
			'USERNAME' => 'Username',
			'USERNAME_R1' => 'Silahkan masukkan Username',
			'USERNAME_R2' => 'Username minimal 4 huruf.',
			'USERNAME_R3' => 'Ada karakter yang invalid pada Username.',
			'USERNAME_R4' => 'Username sudah terdaftar',
			'USERNAME_R5' => 'Username tidak terdaftar',
			'USERNAME_AVAIL' => 'Username Available',
			'USERNAME_NOAVAIL' => 'Username Not Available',
			'PASSWORD' => 'Password',
			'PASSWORD_T' => 'Leave it empty unless changing the password.',
			'PASSWORD_R1' => 'Please Enter Valid Password.',
			'PASSWORD_R2' => 'Password entered is not alphanumeric.',
			'PASSWORD_R3' => 'Your password did not match the confirmed password!',
			'PASSWORD_T2' => 'Password must be at least 6 characters long.',

			'EMAIL_R1' => 'Please Enter Valid Email Address',
			'EMAIL_R2' => 'Entered Email Address Is Already In Use.',
			'EMAIL_R3' => 'Entered Email Address Is Not Valid.',
			'EMAIL_R4' => 'Entered Email Address Does Not Exists.',
			'FNAME' => 'First Name',
			'FNAME_R' => 'Please Enter First Name',
			'LNAME' => 'Last Name',
			'LNAME_R' => 'Please Enter Last Name',
			'ADDRESS' => 'Address',
			'CITY' => 'City',
			'STATE' => 'Province/State',
			'COUNTRY' => 'Country',
			'ZIP' => 'Postal Code/Zip',
			'PHONE' => 'Phone Number',
			'LOGIN_R1' => 'Login dan/atau password tidak dikenal.',
			'LOGIN_R2' => 'Account anda sedang diblokir.',
			'LOGIN_R3' => 'Account anda belum diaktifkan.',
			'LOGIN_R4' => 'You need to verify your email address.',
			'LOGIN_R5' => 'Please enter valid username and password',

			'JAN' => 'Jan',
			'FEB' => 'Feb',
			'MAR' => 'Mar',
			'APR' => 'Apr',
			'MAY' => 'Mei',
			'JUN' => 'Jun',
			'JUL' => 'Jul',
			'AUG' => 'Agu',
			'SEP' => 'Sep',
			'OCT' => 'Okt',
			'NOV' => 'Nop',
			'DEC' => 'Des',
			'JAN_L' => 'Januari',
			'FEB_L' => 'Februari',
			'MAR_L' => 'Maret',
			'APR_L' => 'April',
			'MAY_L' => 'Mei',
			'JUN_L' => 'Juni',
			'JUL_L' => 'Juli',
			'AUG_L' => 'Agustus',
			'SEP_L' => 'September',
			'OCT_L' => 'Oktober',
			'NOV_L' => 'Nopember',
			'DEC_L' => 'Desember',
			'SUN' => 'Minggu',
			'MON' => 'Senin',
			'TUE' => 'Selasa',
			'WED' => 'Rabu',
			'THU' => 'Kamis',
			'FRI' => 'Jumat',
			'SAT' => 'Sabtu',

			'CANCEL' => 'Cancel',
			'CLOSE' => 'Close',
			'DOWNLOAD' => 'Download',
			'FILESIZE' => 'Filesize',
			'VERSION' => 'Version',
			'CREATED' => 'Created',
			'TRANS' => 'Transactions',
			'NOTES' => 'Notes',

			'STATUS' => 'Status',
			'ACTION' => 'Action',
			'ACTIONS' => 'Actions',

			'NOPROCCESS' => 'Tidak ada data yang diproses!',
			'DELCONFIRM_TITLE' => 'Hapus Data',
			'DELCONFIRM' => 'Anda yakin akan menghapus data berikut?',
			'DEL_OK' => 'Data berhasil dihapus!',
			'DATA_UPDATED' => 'Data berhasil diupdate!',
			'DATA_ADDED' => 'Data berhasil ditambahkan!',

			'ADMINONLY' => '<span>Alert!</span>Sorry you don\'t have administrative privilege to access this page',

			/* == Class Paginator::  == */
			'PREV' => 'Prev',
			'NEXT' => 'Next',
			'GOTO' => 'Go To',
			'OF' => ' of ',
			'IPP' => 'Per Page',
			
					
			/* == Admin Files  == */
			'FILE_TITLE' => 'Manage Project Files &rsaquo; Edit File',
			'FILE_INFO' => 'Here you can update your project file.',
			'FILE_SUB' => 'Editing Project File &rsaquo; ',
			'FILE_SELPROJ' => 'Select Project',
			'FILE_SELPROJ_R' => 'Please Select Project',
			'FILE_NAME' => 'File Name',
			'FILE_NAME_R' => 'Please Enter Project File Name',
			'FILE_DESC' => 'File Description',
			'FILE_VER' => 'File Version',
			'FILE_ATTACH' => 'Attach File',
			'FILE_ATTACH_R' => 'Please Select File To Upload',
			'FILE_UPDATE' => 'Update File',
			'FILE_TITLE1' => 'Manage Project Files &rsaquo; Add File',
			'FILE_INFO1' => 'Here you can add new project file.',
			'FILE_SUB1' => 'Adding Project File',

			'FILE_TITLE2' => 'Manage Project Files',
			'FILE_INFO2' => 'Here you can manage your project files.',
			'FILE_SUB2' => 'Viewing Project Files',
			'FILE_NOFILES' => '<span>Info!</span>You don\'t have any project files yet...',
			'FILE_DELFILE' => 'Delete Project File',
			'FILE_DELFILE_OK' => '<span>Success!</span>Project File <strong> [FILE] </strong> deleted successfully!',
			'FILE_UPDATED' => '<span>Success!</span>Project File upwidth="100%" dated successfully!',
			'FILE_ADDED' => '<span>Success!</span>Project File added successfully!',
			
			/* == Admin Configuration  == */
			'CONF_TITLE' => 'System Configuration',
			'CONF_INFO' => 'Changes made here will affect the settings of SIM TEDC.',
			'CONF_SUB' => 'Update System Configuration',
			'CONF_COMPANY' => 'Company Name',
			'CONF_COMPANY_T' => 'This is your website slogan which will appear near your website heading',
			'CONF_COMPANY_R' => 'Please Enter Website Name',
			'CONF_URL' => 'Website Url',
			'CONF_URL_T' => 'Insert full URL WITHOUT any trailing slash  (e.g. http://www.yourdomain.com)',
			'CONF_URL_R' => 'Please Enter Website Url',
			'CONF_EMAIL' => 'Company Email',
			'CONF_EMAIL_T' => 'This is the main email notices will be sent to. It is also used as the from \'email\'<br />when emailing other automatic emails',
			'CONF_EMAIL_R' => 'Please enter valid Website Email address',
			'CONF_ADDRESS' => 'Address',
			'CONF_CITY' => 'City',
			'CONF_STATE' => 'Province/State',
			'CONF_POSTCODE' => 'Postal Code',
			'CONF_PHONE' => 'Telephone',
			'CONF_FAX' => 'Fax',

			'CONF_LOGO' => 'Company Logo',
			'CONF_LOGO_R' => 'Illegal file type. Only jpg and png file types allowed.',
			'CONF_DELLOGO' => 'Delete Logo',
			'CONF_DELLOGO_T' => 'If no logo exists, Company Name will be used instead.',
			'CONF_SDATE' => 'Short Date',
			'CONF_LDATE' => 'Long Date',
			'CONF_TZ' => 'Default Time Zone',
			'CONF_WEEK' => 'Week Starts On',
			'CONF_LANG' => 'Default Language',
			'CONF_REGYES' => 'Allow Registrations',
			'CONF_REGYES_T' => 'If Yes clients will be able to register, otherwise manual registration is required',

			'CONF_UPLOADS' => 'Enable Uploads',
			'CONF_AFT' => 'Allowed File Types',
			'CONF_AFT_T' => 'Enter coma , separated file extensions, no spaces.',
			'CONF_MFS' => 'Max File Size',
			'CONF_MFS_T' => 'Enter values in MB',
			'CONF_IPP' => 'Items Per Page',
			'CONF_IPP_T' => 'Default number of items used for pagination',

			'CONF_MAILER' => 'Default Mailer',
			'CONF_MAILER_T' => 'Use PHP Mailer or SMTP protocol for sending emails',
			'CONF_SMTP_HOST' => 'SMTP Hostname',
			'CONF_SMTP_HOST_T' => 'Specify main SMTP server. E.g.:(mail.yourserver.com)',
			'CONF_SMTP_HOST_R' => 'Please Enter Valid SMTP Host',
			'CONF_SMTP_USER' => 'SMTP Username',
			'CONF_SMTP_USER_R' => 'Please Enter Valid SMTP Username!',
			'CONF_SMTP_PASS' => 'SMTP Password',
			'CONF_SMTP_PORT' => 'SMTP Port',
			'CONF_SMTP_PASS_R' => 'Please Enter Valid SMTP Password!',
			'CONF_SMTP_PORT_T' => 'Mail server port ( Can be 25, 26. 456 for GMAIL. 587 for Yahoo ). Ask your host if uncertain.',
			'CONF_SMTP_PORT_R' => 'Please Enter Valid SMTP Port',
			'CONF_UPDATE' => 'Update Configuration',
			'CONF_UPDATED' => '<span>Success!</span>System Configuration updated successfully!',
			
			
			/* == Admin Database Backup  == */
			'DB_TITLE' => 'Database Maintenance',
			'DB_INFO' => 'Make sure your database is backed up frequently. Click on Create backup to manually backup your database.<br />The backups are stored in the [<strong>/admin/backups/</strong>] folder and can be downloaded from the list below. <br />Your most recent backup is highlighted. Make sure you download your most recent backup, and delete the rest.',
			'DB_SUB' => 'Viewing Backups',
			'DB_DOBACKUP' => 'Create Backup',
			'DB_DORESTORE' => 'Restore Database',
			'DB_RESTORE' => 'Restore Backup',
			'DB_DELETE' => 'Delete Database Backup',
			'DB_DELETE_OK' => '<span>Success!</span>Backup deleted successfully!',
			'DB_CREATED' => '<span>Success!</span>Backup created successfully!',
			'DB_RESTORED' => '<span>Success!</span>Database restored successfully!',
						
											
			/* == Admin Messages  == */
			'MSG_TITLE' => 'Manage Instant Messages  &rsaquo; View Message',
			'MSG_INFO' => 'Here you can view and reply to your messages.',
			'MSG_SUB' => 'Viewing &rsaquo; ',
			'MSG_SENDER' => 'Sender Name',
			'MSG_SENT' => 'Message Sent',
			'MSG_DATESENT' => 'Date Sent',
			'MSG_SUBJECT' => 'Message Subject',
			'MSG_STATUS' => 'Message Status',
			'MSG_TITLE1' => 'Manage Instant Messages  &rsaquo; Send Message',
			'MSG_INFO1' => 'Here you can view and send a new message.',
			'MSG_SUB1' => 'Adding New Message',
			'MSG_RECEPIENT' => 'Recipient',
			'MSG_RECEPIENT_T' => 'Select Recipient',
			'MSG_RECEPIENT_R' => 'Please Select Recipient',
			'MSG_MSGERR1' => 'Please Enter Your Subject',
			'MSG_MSGERR2' => 'Please Enter Your Message',
			'MSG_TITLE2' => 'Manage Instant Messages',
			'MSG_INFO2' => 'Here you can manage your instant messages.',
			'MSG_SUB2' => 'Viewing Instant Messages',
			'MSG_RESET' => 'Reset Message Filter',
			'MSG_UNREAD' => 'Unread Messages',
			'MSG_ADDNEW' => 'Compose New Message',
			'MSG_ESUBJECT' => 'New Message - '/* email subject */,
			'MSG_NOMSG' => '<span>Info!</span>You don\'t have any messages yet...',
			'MSG_SENTOK' => '<span>Success!</span>Message sent successfully!',
			'MSG_DELETE' => 'Delete Message',
			'MSG_DELETE_OK' => '<span>Success!</span>Message From <strong> [MESSAGE] </strong> deleted successfully!',
		
			/* == Front Login  == */
			'LOGIN_INFO' => 'Please enter your valid username and password to login into your account.',
			'LOGIN_SUB' => 'Account Login',
			'LOGIN_BUT_NOW' => 'Login Now',
			'LOGIN_PASS_RESET' => 'Password Reset',
			'LOGIN_REG_NOW' => 'Register Account',
			'LOGIN_INFO1' => 'Enter your username and email address below to reset your password. A verification token will be sent to your email address.<br />Once you have received the token, you will be able to choose a new password for your account.',
			'LOGIN_SUB1' => 'Lost Password',
			'LOGIN_SUBMIT' => 'Submit Request',

			/* == Front Pass Reset  == */
			'PASS_OK' => '<span>Success!</span>You have successfully changed your password. Please check your email for further info!',
			'PASS_ERR' => '<span>Error!</span>There was an error during the process. Please contact the administrator.',
			'PASS_ESUBJECT' => 'Password Reset Request - '/* email subject */,
			
			/* == Front Register  == */
			'REG_TITLE' => 'User Registration',
			'REG_INFO' => 'Please fill out the form below to register your account.',
			'REG_SUB' => 'Create Account',
			'REG_SUBMIT' => 'Register Account',
			'REG_BACK' => 'Back to login',
			'REG_MSGOK' => '<span>Success!</span>You have successfully registered. <a href="index.php">Click here to login</a>',
			'REG_ERR' => '<span>Error!</span>There was an error during registration process. Please contact the administrator...',
			'REG_ESUBJECT' => 'Welcome to - '/* email subject */,
			
			/* == Front Profile  == */
			'PRO_TITLE' => 'Manage Your Account',
			'PRO_INFO' => 'Here you can make changes to your profile',
			'PRO_SUB' => 'User Account Edit',
			'PRO_SUBMIT' => 'Update Profile',
			'PRO_MSGOK' => '<span>Success!</span>Profile updated successfully!'
														

	  );
      
	  return $lang[$phrase];
  }
?>
