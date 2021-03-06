Users
#####

List All Users
==============
``GET /users``
--------------
Returns a list of all users who have an account on the panel.

Request
^^^^^^^
.. code-block:: curl

	curl -X GET -i -H "X-Access-Token: ABCDEFGH-1234-5678-0000-abcdefgh" https://example.com/api/users

Response
^^^^^^^^
.. code-block:: json

	{
		"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx": {
			"id": 1,
			"username": "demoaccount",
			"email": "some@example.com",
			"admin": 1
		},
		"yyyyyyyy-yyyy-yyyy-yyyy-yyyyyyyy": {
			"id": 2,
			"username": "demoaccount2",
			"email":"two@example.com",
			"admin": 0
		}
	}

List a Specific User
====================
``GET /users/:uuid``
--------------------
Returns information about the requested user.

Parameters
^^^^^^^^^^
+--------+------------+-----------+----------------------------------------------------------+
| Method | Parameter  | Required  | Description                                              |
+========+============+===========+==========================================================+
| GET    | uuid       | yes       | The UUID of the user that you wish to return data about. |
+--------+------------+-----------+----------------------------------------------------------+

Request
^^^^^^^
.. code-block:: curl

	curl -X GET -i -H "X-Access-Token: ABCDEFGH-1234-5678-0000-abcdefgh" https://example.com/api/users/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx

Response
^^^^^^^^
.. code-block:: json

	{
		"id": 1,
		"username": "demoaccount",
		"email": "some@example.com",
		"admin": 1,
		"servers": [
			"aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaa",
			"bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbb"
		]
	}

Create a New User
=================
``POST /users``
---------------
Creates a new user based on data sent in a JSON request.

Parameters
^^^^^^^^^^
+--------+------------+-----------+---------------------------------------------------------------------+
| Method | Parameter  | Required  | Description                                                         |
+========+============+===========+=====================================================================+
| POST   |            | yes       | A JSON formatted array containing the information for the new user. |
+--------+------------+-----------+---------------------------------------------------------------------+

Request
^^^^^^^
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
| Parameter | Required | Description                                                                                                          |
+===========+==========+======================================================================================================================+
| username  | yes      | Username for the user to create. Must be between 4 and 16 characters.                                                |
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
| email     | yes      | Email for the new user.                                                                                              |
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
| password  | yes*     | The raw password for the given user. Can be overridden by using the options variable.                                |
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
| admin     | yes      | Wether or not this user is an administrator. Send ``1`` for yes, ``0`` for false.                                    |
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
| options   | yes      | An array of boolean options including ``email`` (send email to new user) and ``password`` (generate custom password).|
+-----------+----------+----------------------------------------------------------------------------------------------------------------------+
.. code-block:: json

	{
		"username": "someusername",
		"email": "new@example.com",
		"password": null,
		"admin": 0,
		"options": {
			"email": false,
			"password": true
		}
	}

.. code-block:: curl

	curl -X POST -i \
		-H "X-Access-Token: ABCDEFGH-1234-5678-0000-abcdefgh" \
		-H "Content-Type: application/json" \
		-d '{"username":"someusername","email":"new@example.com","password":null,"admin":0,"options":{"email":false,"password":true}}' \
		https://example.com/api/users

Response
^^^^^^^^
.. code-block:: json

	{
		"uuid": "gggggggg-gggg-gggg-gggg-ggggghggg"
	}


Update a User
=============
``PUT /users/:uuid``
--------------------
Updates user information.

Parameters
^^^^^^^^^^
+--------+------------+-----------+-----------------------------------------------------------------------+
| Method | Parameter  | Required  | Description                                                           |
+========+============+===========+=======================================================================+
| GET    | uuid       | yes       | The UUID of the user that you wish to return data about.              |
+--------+------------+-----------+-----------------------------------------------------------------------+
| PUT    |            | yes       | A JSON formatted array with all of the variables you want to update.  |
+--------+------------+-----------+-----------------------------------------------------------------------+

Request
^^^^^^^
The parameters below do not all have to be sent, you can send whichever one(s) you want to update.

+----------------+------------------------------------------------------------------------------------------------------------------------------+
| Parameter      | Description                                                                                                                  |
+================+==============================================================================================================================+
| whmcs_id       | The WHMCS/BoxBilling/etc. ID of the user. *Not currently used.*                                                              |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| username       | New username, must be between 4 and 16 characters.                                                                           |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| email          | New email for the new user.                                                                                                  |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| password       | The plain-text password for a user, will be hashed server-side. **Will only be accepted if sent over a HTTPS connection.**   |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| language       | The language key for this users, default install is ``en``.                                                                  |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| root_admin     | Wether or not this user is an administrator. Send ``1`` for true, ``0`` for false.                                           |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| notify_login_s | Wether or not this user should recieve an email for **successful** account logins. Send ``1`` for true, ``0`` for false.     |
+----------------+------------------------------------------------------------------------------------------------------------------------------+
| notify_login_d | Wether or not this user should recieve an email for **failed** account logins. Send ``1`` for true, ``0`` for false.         |
+----------------+------------------------------------------------------------------------------------------------------------------------------+

.. code-block:: curl

	curl -X PUT -i \
		-H "X-Access-Token: ABCDEFGH-1234-5678-0000-abcdefgh" \
		-H "Content-Type: application/json" \
		-d '{"email": "new@example.com","admin": 0}' \
		https://example.com/api/users/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx

Response
^^^^^^^^
.. code-block:: text

	HTTP/1.x 204 No Content

Delete a User
=============
``DELETE  /users/:uuid``
------------------------
Deletes a user given a specified UUID. This currently only disables the account and any associated servers.

Parameters
^^^^^^^^^^
+--------+------------+-----------+----------------------------------------------------------+
| Method | Parameter  | Required  | Description                                              |
+========+============+===========+==========================================================+
| GET    | uuid       | yes       | The UUID of the user that you wish to return data about. |
+--------+------------+-----------+----------------------------------------------------------+

Request
^^^^^^^
.. code-block:: curl

	curl -X DELETE -i -H "X-Access-Token: ABCDEFGH-1234-5678-0000-abcdefgh" https://example.com/api/users/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx

Response
^^^^^^^^
.. code-block::

	HTTP/1.x 204 No Content
