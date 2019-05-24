# 2waysms-checkout

[Medium post](https://medium.com/p/babfdaedb818)

You can use Africa's Talking Ltd Payments API to collect money through SMS.

For this tutorial, we will use PHP. However, you can find code samples in other languages here.

## How It Works

You will send a user a payment reminder via SMS to which they will reply then get a mobile checkout request. They will then enter their pin and confirm the payment.

## What you will need

An Africa's Talking Ltd account
An SMS shortcode: create one here
A payments product.

## The Code

First, send the initial SMS request as follows:

table rows:

Table 1: user details

- firstname
- lastname
- phonenumber
- loan limit
- loan status
  
Table 2: loan status

- amount borrowed/loaned
- amount due
- duration of loan
- loan status

To ask for a loan send a message with the amount you want to get e.g
1500

Building a Loaning platform with just USSD and SMS

USSD is for registration/initial data collection

SMS is for requesting loans

B2C for sending out money

SMS for repayment reminders.

C2B for repayment requests.

Airtime reward for early repayment

Database design:

One table for loanee details

user info:
phone number
names
loan duration


loan limit

One table for loan details:
amount loaned
phonenumber
date due.