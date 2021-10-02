# CMS-Widget-Corp
This repository contains source files for a fictional company called widget-corp. There are 2 main users - the admin and public.
It has been written in PHP and has been integrated with a MySQL database using the mysqli database API.<br>
<a href="https://github.com/mans00rahmed/Widget_Corp/blob/master/Scema_widget_corp.pdf"><b>Schema For Database</b></a>
<br>
Schema for the Database</b>
The following descrition gives you all the details about the CMS.
________________________________________
<img src="https://github.com/mans00rahmed/Widget_Corp/blob/master/Capture.PNG">

_There are 2 basic work areas in the CMS - the Public Area and the Admin Area._

_The functionalities implemented for the Public Area:_

**Site pages**
`1.navigation` 
`2.page content`
`3.read only`

_The functionalities implemented for the Admin Area can be undertood at 3 levels:_


Level 1:

**Login Page** 
`1.form` 
`2.username`
`3.password.`

Level 2:

**Admin Menu**
`1.manage content`
`2.manage admins`
`3.logout`

_We have 3 sub-components at the next level, each of them interacting with the Admin Menu at Level 2._

Level 3:

Sub-component 1: 

**Manage content**
`1.navigation`
`2.subjects CRUD`
`3.pages CRUD`

Sub-component 2: 

**Manage admins**
`1.admins CRUD`

Sub-component 3:

**Logout:**
`1.do logout` 
`2.back to login.`
