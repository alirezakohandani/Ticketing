## Ticketing Module

How the ticketing module works is described below:
1- Guest users can send a support ticket, receive a tracking code and register.
http://test.com/api/v1/tickets
method => POST
| Parameters | Descriptions |
| ------ | ------ |
| email | email type | 
| type | enum('immediate', 'normal', 'nonsignificant') |
| title | title ticket |
| description | description ticket |

2- Users can log in and track their tickets.
http://test.com/api/v1/tickets
method => GET

3- Guest users can see the status of their ticket by sending a ref_number.
http://test.com/api/v1/tickets/{ref_number}
method => GET