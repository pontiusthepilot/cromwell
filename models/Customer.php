<?php

    class Customer {
        private $conn;
        private $table = 'customer';

        public $id;
        public $forenames;
        public $surname;
        public $title;
        public $date_of_birth;
        public $mobile_number;
        public $phone_number;
        public $email_address;
        public $password;
        public $repeatpassword;

        public $errors;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get()
        {
            $query = 'select * from ' .
            $this->table .
            ' where id = ?'; 

            $stmt = $this->conn->prepare($query);

            $stmt->execute($this->id);

            return $stmt;
        }

        public function getCustomerForLogin()
        {
            $query = 'select id, forenames, email_address, password from ' .
            $this->table .
            ' where email_address = :email_address'; 

            $stmt = $this->conn->prepare($query);

            $this->email_address = filter_var($this->email_address, FILTER_SANITIZE_EMAIL);
            $this->password = filter_var($this->password, FILTER_SANITIZE_STRING);

            $stmt->bindParam(':email_address', $this->email_address);

            $stmt->execute();

            return $stmt;
        }

        public function getPassword()
        {
            $query = 'select password from ' .
            $this->table .
            ' where id = ?'; 

            $stmt = $this->conn->prepare($query);

            $stmt->execute(array($this->id));

            return $stmt;
        }

        public function post()
        {
            $this->errors = array();

            $query = 'insert into ' .
            $this->table .
            ' set
                forenames = :forenames,
                surname = :surname,
                title = :title,
                date_of_birth = :date_of_birth, 
                mobile_number = :mobile_number, 
                phone_number = :phone_number, 
                email_address = :email_address, 
                password = :password';

            $stmt = $this->conn->prepare($query);

            $this->forenames = filter_var($this->forenames, FILTER_SANITIZE_STRING);
            $this->surname = filter_var($this->surname, FILTER_SANITIZE_STRING);
            $this->title = filter_var($this->title, FILTER_SANITIZE_STRING);
            $this->date_of_birth = filter_var($this->date_of_birth, FILTER_SANITIZE_STRING);
            $this->mobile_number = filter_var($this->mobile_number, FILTER_SANITIZE_STRING);
            $this->phone_number = filter_var($this->phone_number, FILTER_SANITIZE_STRING);
            $this->email_address = filter_var($this->email_address, FILTER_SANITIZE_EMAIL);

            if ( ! $this->validate_input() )
            {
                return false;
            }

            $stmt->bindParam(':forenames', $this->forenames);
            $stmt->bindParam(':surname', $this->surname);
            $stmt->bindParam(':title', $this->title);

            $dt = DateTime::createFromFormat('d/m/Y', $this->date_of_birth);

            $stmt->bindParam(':date_of_birth', $dt->format('Y-m-d'));
            $stmt->bindParam(':mobile_number', $this->mobile_number);
            $stmt->bindParam(':phone_number', $this->phone_number);
            $stmt->bindParam(':email_address', $this->email_address);
            $stmt->bindParam(':password', $this->password);
            // $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
            
            if ( $stmt->execute() ) {
                return true;
            }

            return false;
        }

        public function put()
        {
            $this->errors = array();

            $query = 'update ' .
            $this->table .
            ' set
                forenames = :forenames,
                surname = :surname,
                title = :title,
                date_of_birth = :date_of_birth, 
                mobile_number = :mobile_number, 
                phone_number = :phone_number, 
                email_address = :email_address, 
                password = :password
            where id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
            $this->forenames = filter_var($this->forenames, FILTER_SANITIZE_STRING);
            $this->surname = filter_var($this->surname, FILTER_SANITIZE_STRING);
            $this->title = filter_var($this->title, FILTER_SANITIZE_STRING);
            $this->date_of_birth = filter_var($this->date_of_birth, FILTER_SANITIZE_STRING);
            $this->mobile_number = filter_var($this->mobile_number, FILTER_SANITIZE_STRING);
            $this->phone_number = filter_var($this->phone_number, FILTER_SANITIZE_STRING);
            $this->email_address = filter_var($this->email_address, FILTER_SANITIZE_EMAIL);

            if ( ! $this->validate_input() )
            {
                return false;
            }

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':forenames', $this->forenames);
            $stmt->bindParam(':surname', $this->surname);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':date_of_birth', $this->date_of_birth);
            $stmt->bindParam(':mobile_number', $this->mobile_number);
            $stmt->bindParam(':phone_number', $this->phone_number);
            $stmt->bindParam(':email_address', $this->email_address);
            $stmt->bindParam(':password', $this->password);

            $result = $this->getPassword(array($this->id));
            $current_password = $result->fetch(PDO::FETCH_ASSOC);

            if ($current_password['password'] != $this->password)
            {
                $pass = password_hash($this->password, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $pass);
            }

            if ( $stmt->execute() ) {
                return true;
            }

            return false;
        }

        public function delete()
        {
            $query = 'delete from ' .
            $this->table .
            ' where id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

            $stmt->bindParam(':id', $this->id);

            if ( $stmt->execute() ) {
                return true;
            }

            return false;
        }

        public function validate_input()
        {
            $this->errors['forenemes'] = $this->validate_forenemes($this->forenames);
            $this->errors['surname'] = $this->validate_surname($this->surname);
            $this->errors['title'] = $this->validate_title($this->title);
            $this->errors['date_of_birth'] = $this->validate_date_of_birth($this->date_of_birth);
            $this->errors['mobile_number'] = $this->validate_mobile_number($this->mobile_number);
            $this->errors['phone_number'] = $this->validate_phone_number($this->phone_number);
            $this->errors['email_address'] = $this->validate_email_address($this->email_address);
            $this->errors['password'] = $this->validate_password($this->password, $this->repeatpassword);

            foreach ($this->errors as $key => $value) {
                if ($value != 'valid') {
                    return false;
                }
            }

            return true;
        }

        public function validate_forenemes($forenames)
        {
            if ( strlen($forenames ) == 0 )
            {
                return 'Please enter a forename';
            }

            return 'valid';
        }

        public function validate_surname($surname)
        {
            if ( strlen($surname) == 0 )
            {
                return 'Please enter a surname';
            }

            return 'valid';
        }

        public function validate_title($title)
        {
            if ( strlen($title) == 0 )
            {
                return 'Please enter a title';
            }

            return 'valid';
        }

        public function validate_date_of_birth($date_of_birth)
        {
            if ( ! strlen($date_of_birth) == 0 )
            {
                if ( ! DateTime::createFromFormat('d/m/Y', $date_of_birth) )
                {
                    return 'Please enter valid date';
                }
            }

            return 'valid';
        }

        public function validate_mobile_number($mobile_number)
        {
            if ( strlen($mobile_number) == 0 )
            {
                return 'Please enter a valid mobile number';
            }
            else
            {
                $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

                $match = preg_match($pattern, $mobile_number);
                
                if ( $match == false ) {
                    return 'Please enter a valid mobile number';
                }
            }

            return 'valid';
        }

        public function validate_phone_number($phone_number)
        {
            if ( strlen($phone_number) == 0 )
            {
                return 'Please enter a valid phone number';
            }
            else
            {
                $pattern = "/^((\(?0\d{4}\)?\s?\d{3}\s?\d{3})|(\(?0\d{3}\)?\s?\d{3}\s?\d{4})|(\(?0\d{2}\)?\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/";
                
                if ( ! preg_match($pattern, $phone_number) ) {
                    return 'Please enter a valid phone number';
                }
            }

            return 'valid';
        }

        public function validate_email_address($email_address)
        {
            if ( ! filter_var($email_address, FILTER_VALIDATE_EMAIL) ) {
                return 'Please enter a valid email_address';
            }

            return 'valid';
        }

        public function validate_password($password, $repeatpassword)
        {
            if ( strlen($password) == 0 )
            {
                return 'Please enter a password';
            }

            if ( strlen($repeatpassword) == 0 )
            {
                return 'Please enter the repeatpassword';
            }

            if ($password !== $repeatpassword)
            {
                return 'The passwords do not match';
            }

            return 'valid';
        }
    }