# Lab 6 — my answers
Name: Ryan Wachira · Admission number: 227580

1. In process-delivery.php, the browser already checks the member number. Why does PHP check it again? Name one way the browser's check can be skipped.

The browser check runs on the visitor's own machine, so it cannot be trusted on its own. JavaScript can be switched off in the browser, and a request can also be sent straight to process-delivery.php without my form at all, for example with curl, so the form is never seen. PHP checks again on the server because that check cannot be skipped, and it is the one standing between a bad value and my database.

2. In my INSERT, bind_param has the letters 'issd'. What does each letter stand for, and which value does it go with?

The letters describe the four values in the same order as the question marks. The i is an integer and goes with the farmer_id found from the member number, the first s is a string for the delivery date, the second s is a string for the session (MORNING or EVENING), and the d is a double, a decimal number, for the litres.

3. Why is Delete a small form sent by post, while Edit is a link?

Opening the edit page only reads one delivery and fills a form, so a link is safe: following it changes nothing. Deleting removes a row, and links get followed by things that are not people, like search engines and browsers fetching pages early, so a delete link could remove a delivery nobody chose to delete. Sending delete by post means it only happens when the button in the form is actually pressed.

4. Someone opens deliveries.php?date=' OR '1'='1 on my site. What happens, and why does my prepared statement not run it as SQL?

The page shows "No deliveries recorded on this day." The date from the address is bound with bind_param, so MySQL receives it as one string value and compares it with the delivery_date column exactly as written. No delivery has that as its date, so nothing matches. The SQL of the statement was already fixed when it was prepared, so the text a visitor types can never become part of the query itself.
