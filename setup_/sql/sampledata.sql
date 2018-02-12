-- ================================================================
--
-- @version $Id: structure.sql 2011-05-25 10:12:05 gewa $
-- @package Freelance Manager
-- @copyright 2011.
--
-- ================================================================
-- Database data
-- ================================================================

--
-- Dumping data for table `estimator`
--

INSERT INTO `estimator` (`id`, `title`, `form_data`, `form_hash`, `template`, `mailto`, `captcha`, `description`, `sendmessage`, `submit_btn`, `created`, `active`) VALUES
(1, 'Get Started Now!', 'a:13:{i:0;a:3:{s:8:"cssClass";s:11:"simplelabel";s:8:"required";s:9:"undefined";s:6:"values";s:16:"Personal Details";}i:1;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:7:"checked";s:6:"values";s:10:"First Name";}i:2;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:7:"checked";s:6:"values";s:9:"Last Name";}i:3;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:7:"checked";s:6:"values";s:13:"Email Address";}i:4;a:3:{s:8:"cssClass";s:11:"simplelabel";s:8:"required";s:9:"undefined";s:6:"values";s:34:"Essential Project Details (Design)";}i:5;a:6:{s:8:"cssClass";s:6:"select";s:8:"required";s:9:"undefined";s:8:"multiple";s:9:"undefined";s:5:"title";s:45:"How many mockups would you like us to create?";s:6:"values";a:4:{i:2;a:2:{s:5:"value";s:19:"Choose Build Option";s:8:"baseline";s:7:"checked";}i:4;a:2:{s:5:"value";s:8:"1 Design";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:9:"2 Designs";s:8:"baseline";s:9:"undefined";}i:8;a:2:{s:5:"value";s:9:"3 Designs";s:8:"baseline";s:9:"undefined";}}s:6:"prices";a:4:{i:3;a:1:{s:5:"price";s:1:"0";}i:5;a:1:{s:5:"price";s:3:"100";}i:7;a:1:{s:5:"price";s:3:"175";}i:9;a:1:{s:5:"price";s:3:"250";}}}i:6;a:5:{s:8:"cssClass";s:8:"checkbox";s:8:"required";s:9:"undefined";s:5:"title";s:64:"Are there any other design services that we can provide for you?";s:6:"values";a:3:{i:2;a:2:{s:5:"value";s:11:"Logo Design";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:14:"Business Cards";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:8:"Brochure";s:8:"baseline";s:9:"undefined";}}s:6:"prices";a:3:{i:3;a:1:{s:5:"price";s:3:"150";}i:5;a:1:{s:5:"price";s:3:"175";}i:7;a:1:{s:5:"price";s:3:"200";}}}i:7;a:3:{s:8:"cssClass";s:11:"simplelabel";s:8:"required";s:9:"undefined";s:6:"values";s:39:"Essential Project Details (Development)";}i:8;a:6:{s:8:"cssClass";s:6:"select";s:8:"required";s:9:"undefined";s:8:"multiple";s:9:"undefined";s:5:"title";s:51:"How many HTML pages do you need us to code for you?";s:6:"values";a:5:{i:2;a:2:{s:5:"value";s:22:"Choose Number of Pages";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:6:"1 Page";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:9:"2-5 Pages";s:8:"baseline";s:9:"undefined";}i:8;a:2:{s:5:"value";s:10:"5-10 Pages";s:8:"baseline";s:9:"undefined";}i:10;a:2:{s:5:"value";s:10:"10 + Pages";s:8:"baseline";s:9:"undefined";}}s:6:"prices";a:5:{i:3;a:1:{s:5:"price";s:1:"0";}i:5;a:1:{s:5:"price";s:3:"200";}i:7;a:1:{s:5:"price";s:3:"250";}i:9;a:1:{s:5:"price";s:3:"300";}i:11;a:1:{s:5:"price";s:3:"400";}}}i:9;a:5:{s:8:"cssClass";s:8:"checkbox";s:8:"required";s:9:"undefined";s:5:"title";s:69:"Are there any other development services that we can provide for you?";s:6:"values";a:5:{i:2;a:2:{s:5:"value";s:12:"Contact Form";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:13:"Photo Gallery";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:17:"Responsive Design";s:8:"baseline";s:9:"undefined";}i:8;a:2:{s:5:"value";s:11:"Web Hosting";s:8:"baseline";s:9:"undefined";}i:10;a:2:{s:5:"value";s:24:"Domain Name Registration";s:8:"baseline";s:9:"undefined";}}s:6:"prices";a:5:{i:3;a:1:{s:5:"price";s:3:"200";}i:5;a:1:{s:5:"price";s:3:"250";}i:7;a:1:{s:5:"price";s:3:"150";}i:9;a:1:{s:5:"price";s:2:"25";}i:11;a:1:{s:5:"price";s:2:"10";}}}i:10;a:5:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:42:"Would you like a Content Mangement System?";s:6:"values";a:4:{i:2;a:2:{s:5:"value";s:9:"No Thanks";s:8:"baseline";s:7:"checked";}i:4;a:2:{s:5:"value";s:8:"CMS pro!";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:9:"Wordpress";s:8:"baseline";s:9:"undefined";}i:8;a:2:{s:5:"value";s:6:"Joomla";s:8:"baseline";s:9:"undefined";}}s:6:"prices";a:4:{i:3;a:1:{s:5:"price";s:1:"0";}i:5;a:1:{s:5:"price";s:3:"100";}i:7;a:1:{s:5:"price";s:3:"200";}i:9;a:1:{s:5:"price";s:3:"350";}}}i:11;a:3:{s:8:"cssClass";s:11:"simplelabel";s:8:"required";s:9:"undefined";s:6:"values";s:26:"Additional Project Details";}i:12;a:3:{s:8:"cssClass";s:8:"textarea";s:8:"required";s:9:"undefined";s:6:"values";s:81:"Please provide us with a little more information so I can get started right away!";}}', 'cda2e8c86b8ad3510b3d734fce469ad22415a70e', '&lt;div align=&quot;center&quot;&gt;  \n	&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;    \n		&lt;tbody&gt;      \n			&lt;tr&gt;        \n				&lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;      \n			&lt;/tr&gt;      \n			&lt;tr&gt;        \n				&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new [FORMNAME] request: &lt;hr /&gt;\n					           [FORMDATA] &lt;/td&gt;      \n			&lt;/tr&gt;    \n		&lt;/tbody&gt;  \n	&lt;/table&gt;&lt;/div&gt;', 'webmaster@yourdomain.com', 1, 'Please fill out this form with as much information about your project as possible. As you select your project requirements you will see your order summary at the right side. This form updates automatically. Note: There will be no payment processed through this form; this is just an estimate.', 'Thank you! We will contact you shortly.', 'Submit Form', '2011-09-12 14:20:02', 1);

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `title`, `form_data`, `form_hash`, `template`, `mailto`, `captcha`, `sendmessage`, `submit_btn`, `created`, `active`) VALUES
(1, 'Web Site Visitor Survey', 'a:9:{i:0;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:40:"How did you first learn of our web site?";s:6:"values";a:5:{i:2;a:2:{s:5:"value";s:13:"Advertisement";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:9:"Billboard";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:19:"Email or Newsletter";s:8:"baseline";s:9:"undefined";}i:5;a:2:{s:5:"value";s:13:"Search Engine";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:5:"Other";s:8:"baseline";s:9:"undefined";}}}i:1;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:9:"undefined";s:6:"values";s:24:"If other, please specify";}i:2;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:48:"What was your main reason for visiting our site?";s:6:"values";a:3:{i:2;a:2:{s:5:"value";s:18:"Gather information";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:7:"Curious";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:13:"Other Reasons";s:8:"baseline";s:9:"undefined";}}}i:3;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:7:"checked";s:5:"title";s:20:"What is your gender?";s:6:"values";a:2:{i:2;a:2:{s:5:"value";s:4:"Male";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:6:"Female";s:8:"baseline";s:9:"undefined";}}}i:4;a:3:{s:8:"cssClass";s:10:"datepicker";s:8:"required";s:9:"undefined";s:6:"values";s:13:"Date Of Birth";}i:5;a:4:{s:8:"cssClass";s:8:"checkbox";s:8:"required";s:7:"checked";s:5:"title";s:47:"What browser do you use to access the Internet?";s:6:"values";a:5:{i:2;a:2:{s:5:"value";s:17:"Internet Explorer";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:7:"Firefox";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:6:"Chrome";s:8:"baseline";s:9:"undefined";}i:5;a:2:{s:5:"value";s:5:"Opera";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:5:"Other";s:8:"baseline";s:9:"undefined";}}}i:6;a:5:{s:8:"cssClass";s:6:"select";s:8:"required";s:7:"checked";s:8:"multiple";s:9:"undefined";s:5:"title";s:30:"In which industry do you work?";s:6:"values";a:4:{i:2;a:2:{s:5:"value";s:10:"Accounting";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:11:"Advertising";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:16:"Food and Service";s:8:"baseline";s:9:"undefined";}i:5;a:2:{s:5:"value";s:5:"Other";s:8:"baseline";s:9:"undefined";}}}i:7;a:3:{s:8:"cssClass";s:8:"textarea";s:8:"required";s:7:"checked";s:6:"values";s:22:"Additional Information";}i:8;a:3:{s:8:"cssClass";s:8:"uploader";s:8:"required";s:9:"undefined";s:6:"values";s:11:"Attach File";}}', '3364c2a4d05c0c115cf762bc33a0272b5a80cdbc', '&lt;div align=&quot;center&quot;&gt;  \n	&lt;table width=&quot;600&quot; cellspacing=&quot;5&quot; cellpadding=&quot;5&quot; border=&quot;0&quot; style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot;&gt;    \n		&lt;tbody&gt;      \n			&lt;tr&gt;        \n				&lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt;      \n			&lt;/tr&gt;      \n			&lt;tr&gt;        \n				&lt;td valign=&quot;top&quot; style=&quot;text-align: left;&quot;&gt;You have a new [FORMNAME] request: &lt;hr /&gt;\n					           [FORMDATA] &lt;/td&gt;      \n			&lt;/tr&gt;    \n		&lt;/tbody&gt;  \n	&lt;/table&gt;&lt;/div&gt;', 'webmaster@yourdomain.com', 1, 'Thank you! We appreciate your input', 'Submit Survey', '2011-09-12 14:20:02', 1),
(2, 'Webdesign Quote', 'a:11:{i:0;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:37:"Which type of website would you like?";s:6:"values";a:4:{i:2;a:2:{s:5:"value";s:39:"A basic &quot;brochure-style&quot; site";s:8:"baseline";s:7:"checked";}i:3;a:2:{s:5:"value";s:30:"An e-commerce site/online shop";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:27:"A content management system";s:8:"baseline";s:9:"undefined";}i:5;a:2:{s:5:"value";s:41:"Other type of advanced, feature-rich site";s:8:"baseline";s:9:"undefined";}}}i:1;a:3:{s:8:"cssClass";s:8:"textarea";s:8:"required";s:9:"undefined";s:6:"values";s:48:"Describe in detail what you do and what you need";}i:2;a:3:{s:8:"cssClass";s:8:"textarea";s:8:"required";s:9:"undefined";s:6:"values";s:119:"Are there any sites on the Web that are similar to what you are looking for? If so enter their website addresses below:";}i:3;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:68:"How many design companies would you like to receive quotations from?";s:6:"values";a:4:{i:2;a:2:{s:5:"value";s:1:"1";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:1:"2";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:1:"3";s:8:"baseline";s:9:"undefined";}i:5;a:2:{s:5:"value";s:1:"4";s:8:"baseline";s:7:"checked";}}}i:4;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:43:"Where do you want your quotes to come from?";s:6:"values";a:2:{i:2;a:2:{s:5:"value";s:11:"Any country";s:8:"baseline";s:7:"checked";}i:3;a:2:{s:5:"value";s:10:"My country";s:8:"baseline";s:9:"undefined";}}}i:5;a:4:{s:8:"cssClass";s:5:"radio";s:8:"required";s:9:"undefined";s:5:"title";s:59:"How much do you have available to invest into your website:";s:6:"values";a:5:{i:2;a:2:{s:5:"value";s:10:"Under $500";s:8:"baseline";s:9:"undefined";}i:3;a:2:{s:5:"value";s:14:"$500 to $1,000";s:8:"baseline";s:9:"undefined";}i:4;a:2:{s:5:"value";s:16:"$1,000 to $2,500";s:8:"baseline";s:7:"checked";}i:5;a:2:{s:5:"value";s:16:"$2,500 to $5,000";s:8:"baseline";s:9:"undefined";}i:6;a:2:{s:5:"value";s:11:"Over $5,000";s:8:"baseline";s:9:"undefined";}}}i:6;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:7:"checked";s:6:"values";s:10:"Full name:";}i:7;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:9:"undefined";s:6:"values";s:10:"Telephone:";}i:8;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:7:"checked";s:6:"values";s:6:"Email:";}i:9;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:9:"undefined";s:6:"values";s:12:"Town / City:";}i:10;a:3:{s:8:"cssClass";s:10:"input_text";s:8:"required";s:9:"undefined";s:6:"values";s:13:"Your country:";}}', 'f2de28f8cbff4ad1db491ebbfef63bed434f35c8', '&lt;div align=&quot;center&quot;&gt; &lt;table style=&quot;background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);&quot; border=&quot;0&quot; cellpadding=&quot;5&quot; cellspacing=&quot;5&quot; width=&quot;600&quot;&gt; &lt;tbody&gt; &lt;tr&gt; &lt;th style=&quot;background-color: rgb(204, 204, 204);&quot;&gt;Hello Admin&lt;/th&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;You have a new [FORMNAME] request: &lt;hr/&gt; [FORMDATA] &lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt;&lt;/div&gt;', 'webmaster@yourdomain.com', 1, 'Thank you! we will contact you shortly.', 'Submit Request', '2012-01-02 20:54:15', 1);

--
-- Dumping data for table `forms_data`
--

INSERT INTO `forms_data` (`id`, `form_id`, `form_data`, `created`) VALUES
(1, 1, '<table width="100%" cellpadding="3" cellspacing="3">\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">How did you first learn of our web site?</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Email or Newsletter</td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">If other, please specify</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)"></td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">What was your main reason for visiting our site?</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Other Reasons</td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">What is your gender?</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Male</td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Date Of Birth</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">22 November, 1972</td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">What browser do you use to access the Internet?</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Internet Explorer, Firefox, Chrome, </td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">In which industry do you work?</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Accounting, </td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Additional Information</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">No additional Information</td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Attach File</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)"><a href="#">Download Attachment.</a></td>\r\n  </tr>\r\n  <tr>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">Senders IP:</td>\r\n    <td style="border-bottom:1px dotted rgb(102, 102, 102)">127.0.0.1</td>\r\n  </tr>\r\n</table>\n', '2011-11-17 23:31:58');

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `title`, `project_id`, `client_id`, `created`, `duedate`, `amount_total`, `amount_paid`, `method`, `tax`, `status`) VALUES
(1, 'New Invoice', 1, 3, '2010-06-07', '2011-11-12', '259.90', '259.90', 'Online', '29.90', 'Paid'),
(2, 'Pending Invoice', 3, 3, '2011-12-04', '2011-12-02', '203.40', '123.40', 'Offline', '23.40', 'Unpaid');

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`id`, `project_id`, `invoice_id`, `title`, `description`, `amount`, `tax`) VALUES
(1, 1, 1, 'New Entry III', 'Some dscription 1', '120.00', '15.60'),
(2, 1, 1, 'New Entry II', 'Some dscription II', '110.00', '14.30'),
(3, 2, 2, 'New Entry I', 'Basic Troubleshooting', '180.00', '23.40');

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `project_id`, `method`, `amount`, `created`, `description`) VALUES
(1, 1, 1, 'Offline', '30.00', '2011-11-10', 'Reference Offline payment'),
(2, 2, 3, 'Offline', '80.00', '2011-12-04', 'Payment added by admin'),
(3, 2, 3, 'Offline', '25.00', '2011-12-04', 'Payment added by admin'),
(4, 1, 1, 'PayPal', '229.90', '2011-12-01', 'Payment via Paypal'),
(9, 2, 3, 'AuthorizeNet', '10.00', '2011-12-06', 'Payment via AuthorizeNet'),
(8, 2, 3, 'AuthorizeNet', '8.40', '2011-12-06', 'Payment via AuthorizeNet');

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `recipient`, `created`, `msgsubject`, `body`, `status_s`, `status_r`) VALUES
(1, 1, 1, '2012-01-16 23:12:22', 'My site is not working', 'Lorem ipsum dolor sit amet, duo ridens veritus antiopam et. In sit tation facilis graecis, vel brute graeci et. Pri meliore forensibus eu, sea ei omnium impedit. Fastidii intellegat moderatius ei his, sed id quaeque hendrerit definitionem.', 1, 0),
(2, 3, 3, '2012-01-15 22:21:09', 'My site is not working', 'Lorem ipsum dolor sit amet, duo ridens veritus antiopam et. In sit tation facilis graecis, vel brute graeci et. Pri meliore forensibus eu, sea ei omnium impedit. Fastidii intellegat moderatius ei his, sed id quaeque hendrerit definitionem.', 1, 0),
(4, 3, 3, '2012-01-14 21:51:52', 'My site is not working', 'Lorem ipsum dolor sit amet, duo ridens veritus antiopam et. In sit tation facilis graecis, vel brute graeci et. Pri meliore forensibus eu, sea ei omnium impedit. Fastidii intellegat moderatius ei his, sed id quaeque hendrerit definitionem.', 1, 0),
(5, 3, 1, '2012-01-11 14:12:22', 'My site is not working', 'Lorem ipsum dolor sit amet, duo ridens veritus antiopam et. In sit tation facilis graecis, vel brute graeci et. Pri meliore forensibus eu, sea ei omnium impedit. Fastidii intellegat moderatius ei his, sed id quaeque hendrerit definitionem.', 1, 1);

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `author`, `created`, `active`) VALUES
(1, 'Welcome to our Client Area!', '&lt;p&gt;We are pleased to announce that we have installed &lt;em&gt;Freelance &lt;/em&gt;Manager as our new Client Management System! We are extremely excited about this incredible &lt;strong&gt;software!&lt;/strong&gt;&lt;/p&gt;', 'Administrator', '2011-12-15', 1);

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `project_id`, `staff_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1);

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `staff_id`, `project_type`, `title`, `body`, `start_date`, `end_date`, `cost`, `b_status`, `p_status`) VALUES
(1, 3, 1, 1, 'Finished Project', 'This is new project', '2011-12-10 14:16:12', '2011-12-20 20:26:16', '259.90', '259.90', '100'),
(2, 3, 2, 2, 'Pending Project', 'This project is finished', '2011-12-04 20:26:16', '2011-12-10 20:26:16', '350.00', '175.00', '50'),
(3, 3, 1, 2, 'Logo Design', 'Project Description...', '2011-12-09 20:47:29', '2011-12-30 20:47:29', '285.00', '0.00', '0');

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `staff_id`, `project_id`, `client_id`, `title`, `filename`, `filedesc`, `filesize`, `created`, `version`) VALUES
(1, 1, 1, 0, 'Website Layout', 'SOURCE_C5F349-8B94B4-64A6DD-64FE28-6D8F29-67AAD9.zip', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat....', '19456.00', '2011-11-27 22:25:45', '1.0.5'),
(2, 1, 1, 0, 'Database Manupulation', 'SOURCE_4BC68F-587E0A-D50669-86993E-DFF872-F04A84.zip', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', '11264.00', '2011-11-14 18:46:19', '1.00');

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `title`, `description`) VALUES
(1, 'Web Design', 'Default Project Type'),
(2, 'Logo Design', 'Processing logo for publishing'),
(3, 'CMS pro! Theme Design', 'Theme development for CMS pro!');

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `project_id`, `staff_id`, `title`, `description`, `s_type`, `created`, `review_date`, `review`, `reviewed`, `status`) VALUES
(1, 1, 1, 'Submission Name I', 'some content goes here...', 'Draft', '2011-06-01 16:20:11', '2011-06-10 16:20:11', 'I like it go ahead', 0, 1),
(2, 1, 1, 'Submission Name II', 'Notes from admin&lt;br/&gt;', 'Revision', '2011-06-05 12:45:06', '2011-06-08 12:45:06', 'Go for it', 1, 2);

--
-- Dumping data for table `support_responses`
--

INSERT INTO `support_responses` (`id`, `ticket_id`, `author_id`, `user_type`, `created`, `body`) VALUES
(1, 1, 1, 'staff', '2011-12-24 16:20:25', 'Cea atqui novum saperet no, modus abhorreant accommodare eam ea. Eam et nemore intellegebat, dictas nostrum splendide nam an. Pri malis dicta recteque ei, ne sed novum omnes'),
(2, 1, 3, 'client', '2011-12-23 18:20:25', 'icant perpetua sapientem et has, ea est possit maluisset. Sit nostrum voluptatibus ea, sea partem tempor ad, cum magna voluptua te. Mel et scaevola officiis urbanitas, has ad corpora delicata. Audire nusquam corrumpit in nec'),
(3, 1, 1, 'staff', '2011-12-26 17:20:37', 'Vim ex persequeris voluptatibus. Mei at timeam efficiendi.'),
(5, 1, 3, 'client', '2011-12-25 21:01:34', 'Te simul oportere pri, pri ad illud primis commodo. Quas nihil pri eu. Nam id elitr soleat, alterum erroribus usu te. Eam id utinam quaeque, pro quodsi dissentiet at.');

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `staff_id`, `client_id`, `department`, `priority`, `subject`, `body`, `created`, `status`) VALUES
(1, 1, 3, 'Support', 'High', 'My site is down', 'Per ex habeo atomorum vulputate, omnium iudicabit intellegat his id. Diam ridens abhorreant his eu, singulis platonem vim no. In modo mnesarchum per. ', '2011-12-24 14:10:55', 'Open'),
(2, 2, 3, 'Support', 'Medium', 'How do setup my account 	', 'Corrumpit intellegat adversarium ei nec. Ne ridens utamur pertinacia nam. Ei labores reprehendunt per, euismod aliquid ea vel. Prompta equidem maiorum id has, tamquam', '2011-12-24 19:10:55', 'Closed');

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `staff_id`, `client_access`, `author_id`, `title`, `details`, `created`, `duedate`, `progress`) VALUES
(1, 1, 1, 1, 1, 'My New Task I', 'Tale utinam numquam quo ea, quas tation hendrerit quo ei. Erat electram adipiscing no sea', '2011-11-13 15:39:56', '2011-11-30 15:39:56', '75'),
(2, 1, 2, 1, 2, 'My New Task II', 'Tale utinam numquam quo ea, quas tation hendrerit quo ei. Erat electram adipiscing no sea', '2011-11-25 14:25:19', '2011-12-10 15:18:33', '46'),
(3, 1, 2, 1, 2, 'My New Task III', 'Tale utinam numquam quo ea, quas tation hendrerit quo ei. Erat electram adipiscing no sea', '2011-11-27 14:25:19', '2011-11-27 14:25:19', '28');

--
-- Dumping data for table `task_templates`
--

INSERT INTO `task_templates` (`id`, `title`, `details`) VALUES
(1, 'Create Draft Design', 'Pri an viderer eligendi, persius blandit sed ne, eripuit eleifend assueverit in nam. Eum no falli homero admodum, pro eu cibo equidem. Et duo splendide hendrerit similique, an eos accusam consetetur reprehendunt. Ne sit errem labore.'),
(2, 'Set up Hosting', 'Percipitur reprehendunt duo ei. Ei mazim labore blandit vel, torquatos similique has ut. Quo at melius malorum.'),
(3, 'Set up Email Account', 'Cum falli nusquam fastidii et, hinc assentior qui no. Placerat apeirian consetetur et pri. Insolens argumentum reformidans id eam, vel an nostro periculis urbanitas. Partem dolorem nostrum est eu, ad sed primis apeirian, est quod solum nostrum cu.');

--
-- Dumping data for table `time_billing`
--

INSERT INTO `time_billing` (`id`, `staff_id`, `client_id`, `project_id`, `task_id`, `title`, `description`, `hours`, `created`) VALUES
(1, 1, 3, 1, 1, 'New billing entry I', 'Ut mei animal salutatus elaboraret, no elit nominati assentior vix. Sit et putent impetus.', 10, '2011-11-20 15:20:36'),
(2, 1, 3, 1, 1, 'New billing entry II', 'Ut mei animal salutatus elaboraret, no elit nominati assentior vix. Sit et putent impetus.', 25, '2011-11-21 15:20:36'),
(3, 2, 4, 2, 2, 'New billing entry III', 'Ut mei animal salutatus elaboraret, no elit nominati assentior vix. Sit et putent impetus.', 15, '2011-11-22 15:20:36');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`, `company`, `address`, `city`, `state`, `zip`, `country`, `currency`, `phone`, `userlevel`, `created`, `notes`, `lastlogin`, `lastip`, `active`) VALUES
(2, 'john', '42b7b504b2753b71f41780d5e86f1139a2ab5647', 'john@mail.com', 'John', 'Johnson', NULL, '', '', '', '', '', NULL, '', 5, '2011-05-01 18:10:14', 'ulla aliquam pulvinar congue. Morbi quis nisl orci, vel sollicitudin erat. In hac habitasse platea dictumst. Vestibulum congue blandit odio, a pulvinar massa porttitor in. In hac habitasse platea dictumst.', '2012-01-31 07:15:13', '127.0.0.1', 'y'),
(3, 'mike', '42b7b504b2753b71f41780d5e86f1139a2ab5647', 'mike@mail.com', 'Mike', 'Manson', 'Mike&amp;#039;s Company', '17 Main Street #20', 'Hamilton', 'ON', 'L3K 2F6', '', 'CAD', '555-555-5555', 1, '2011-05-02 18:10:14', 'ulla aliquam pulvinar congue. Morbi quis nisl orci, vel sollicitudin erat. In hac habitasse platea dictumst. Vestibulum congue blandit odio, a pulvinar massa porttitor in. In hac habitasse platea dictumst.', '2012-02-04 20:20:30', '127.0.0.1', 'y'),
(4, 'steve', '42b7b504b2753b71f41780d5e86f1139a2ab5647', 'steve@mail.com', 'Steven', 'Swanson', 'Steve&amp;#039;s Company', NULL, NULL, NULL, NULL, '', 'GBP', NULL, 1, '2011-05-03 18:10:14', 'ulla aliquam pulvinar congue. Morbi quis nisl orci, vel sollicitudin erat. In hac habitasse platea dictumst. Vestibulum congue blandit odio, a pulvinar massa porttitor in. In hac habitasse platea dictumst.', '0000-00-00 00:00:00', '127.0.0.1', 'y'),
(5, 'peter', '42308b0e82bd34d6e4dfe5976e752df1b3b8a2e1', 'peter@mail.com', 'Peter', 'Peterson', 'Peter&amp;#039;s Company', '224 Ontario Street #319', 'Toronto', 'ON', 'M2k1g5', '', NULL, '555-555-5555', 1, '2011-12-06 17:37:55', NULL, '0000-00-00 00:00:00', '0', 'y');