**Database design** <br>
There are three tables which include:
- customer
- booking
- reservation

Booking has info of reservation and customer via foreign key. 
Booking and reservation has one-to-one relationship. This means,
reservation must extends booking when designing the models. <br>

**Model design** <br>
`class Booking { }` <br>
`class Reservation extends Booking { }` <br>

**Entity Relationship Diagram** <br>
Reservation shares primary key with booking so when you delete a booking, 
reservation is also deleted. The same scenario applies when deleting a customer.
![diagram](https://user-images.githubusercontent.com/5623994/39007054-e4ccad82-43d2-11e8-8842-6249b3e25905.png)
<br> See [`hotel.sql`](https://github.com/tramyardg/hotel-mgmt-system/blob/master/hotel.sql) for more details.
