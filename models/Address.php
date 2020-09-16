<?php

    class Address {
        private $conn;
        private $table = 'customer_address';

        public $id;
        public $customer_id;
        public $contact_name;
        public $business_name;
        public $address_line1;
        public $address_line2;
        public $city;
        public $county;
        public $country;
        public $postcode;
        public $address_type;

        public $errors;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get()
        {
            $query = 'select * from ' .
            $this->table .
            ' where customer_id = :customer_id
                and contact_name = :contact_name
                and business_name = :business_name
                and address_line1 = :address_line1
                and address_line2 = :address_line2
                and postcode = :postcode'; 

            $this->customer_id = filter_var($this->customer_id, FILTER_SANITIZE_NUMBER_INT);
            $this->contact_name = filter_var($this->contact_name, FILTER_SANITIZE_STRING);
            $this->business_name = filter_var($this->business_name, FILTER_SANITIZE_STRING);
            $this->address_line1 = filter_var($this->address_line1, FILTER_SANITIZE_STRING);
            $this->address_line2 = filter_var($this->address_line2, FILTER_SANITIZE_STRING);
            $this->postcode = filter_var($this->postcode, FILTER_SANITIZE_STRING);

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':customer_id', $this->customer_id);
            $stmt->bindParam(':contact_name', $this->contact_name);
            $stmt->bindParam(':business_name', $this->business_name);
            $stmt->bindParam(':address_line1', $this->address_line1);
            $stmt->bindParam(':address_line2', $this->address_line2);
            $stmt->bindParam(':postcode', $this->postcode);
            
            $stmt->execute();

            return $stmt;
        }

        public function post()
        {
            $this->errors = array();

            $query = 'insert into ' .
            $this->table .
            ' set
                customer_id = :customer_id,
                contact_name = :contact_name,
                business_name = :business_name,
                address_line1 = :address_line1,
                address_line2 = :address_line2,
                city = :city,
                county = :county,
                country = :country,
                postcode = :postcode,
                address_type = :address_type';

            $stmt = $this->conn->prepare($query);

            $this->customer_id = filter_var($this->customer_id, FILTER_SANITIZE_NUMBER_INT);
            $this->contact_name = filter_var($this->contact_name, FILTER_SANITIZE_STRING);
            $this->business_name = filter_var($this->business_name, FILTER_SANITIZE_STRING);
            $this->address_line1 = filter_var($this->address_line1, FILTER_SANITIZE_STRING);
            $this->address_line2 = filter_var($this->address_line2, FILTER_SANITIZE_STRING);
            $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
            $this->country = filter_var($this->country, FILTER_SANITIZE_STRING);
            $this->postcode = filter_var($this->postcode, FILTER_SANITIZE_STRING);
            $this->address_type = filter_var($this->address_type, FILTER_SANITIZE_STRING);

            if ( ! $this->validate_input() )
            {
                return false;
            }

            $stmt->bindParam(':customer_id', $this->customer_id);
            $stmt->bindParam(':contact_name', $this->contact_name);
            $stmt->bindParam(':business_name', $this->business_name);
            $stmt->bindParam(':address_line1', $this->address_line1);
            $stmt->bindParam(':address_line2', $this->address_line2);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':county', $this->county);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':postcode', $this->postcode);
            $stmt->bindParam(':address_type', $this->address_type);

            if ( $stmt->execute() ) {
                return true;
            }

            return false;
        }

        public function put()
        {
            $errors = array();

            $query = 'update ' .
            $this->table .
            ' set
                customer_id = :customer_id,
                contact_name = :contact_name,
                business_name = :business_name,
                address_line1 = :address_line1,
                address_line2 = :address_line2,
                city = :city,
                county = :county,
                country = :country,
                postcode = :postcode,
                address_type = :address_type
            where id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
            $this->customer_id = filter_var($this->customer_id, FILTER_SANITIZE_NUMBER_INT);
            $this->contact_name = filter_var($this->contact_name, FILTER_SANITIZE_STRING);
            $this->business_name = filter_var($this->business_name, FILTER_SANITIZE_STRING);
            $this->address_line1 = filter_var($this->address_line1, FILTER_SANITIZE_STRING);
            $this->address_line2 = filter_var($this->address_line2, FILTER_SANITIZE_STRING);
            $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
            $this->country = filter_var($this->country, FILTER_SANITIZE_STRING);
            $this->postcode = filter_var($this->postcode, FILTER_SANITIZE_STRING);
            $this->address_type = filter_var($this->address_type, FILTER_SANITIZE_STRING);

            if ( ! $this->validate_input() )
            {
                return false;
            }

// var_dump($this->id);die;

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':customer_id', $this->customer_id);
            $stmt->bindParam(':contact_name', $this->contact_name);
            $stmt->bindParam(':business_name', $this->business_name);
            $stmt->bindParam(':address_line1', $this->address_line1);
            $stmt->bindParam(':address_line2', $this->address_line2);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':county', $this->county);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':postcode', $this->postcode);
            $stmt->bindParam(':address_type', $this->address_type);

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
            $this->errors['contact_name'] = $this->validate_contact_name($this->contact_name);
            $this->errors['business_name'] = $this->validate_business_name($this->business_name);
            $this->errors['address_line1'] = $this->validate_address_line1($this->address_line1);
            $this->errors['city'] = $this->validate_city($this->city);
            $this->errors['country'] = $this->validate_country($this->country);
            $this->errors['postcode'] = $this->validate_postcode($this->postcode);
            $this->errors['address_type'] = $this->validate_address_type($this->address_type);

            if ($this->errors['address_type'] == "valid")
            {
                $this->errors['address_type'] = $this->address_type_used($this->customer_id, $this->address_type);
            }
            
            foreach ($this->errors as $key => $value) {
                if ($value != 'valid') {
                    return false;
                }
            }

            return true;
        }

        public function address_type_used($customer_id, $address_type)
        {
            $query = 'select count(*) as count from ' .
            $this->table .
            ' where customer_id = :customer_id
                and address_type = :address_type'; 

            $stmt = $this->conn->prepare($query);

            $this->customer_id = filter_var($customer_id, FILTER_SANITIZE_NUMBER_INT);
            $this->address_type = filter_var($address_type, FILTER_SANITIZE_STRING);

            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->bindParam(':address_type', $address_type);

            if ( ! empty($address_type) )
            {
                if ( $stmt->execute() )
                {
                    $rtn = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (intval($rtn['count']) > 0)
                    {
                        return 'Address type in use';
                    }
                }
            }

            return 'valid';
        }

        public function validate_contact_name($contact_name)
        {
            if ( strlen($contact_name ) == 0 )
            {
                return 'Please enter a contact name';
            }

            return 'valid';
        }

        public function validate_business_name($business_name)
        {
            if ( strlen($this->business_name) == 0 )
            {
                return 'Please enter a business name';
            }

            return 'valid';
        }

        public function validate_address_line1($address_line1)
        {
            if ( strlen($this->address_line1) == 0 )
            {
                return 'Please enter an address line';
            }

            return 'valid';
        }

        public function validate_city($city)
        {
            if ( strlen($this->city) == 0 )
            {
                return 'Please enter a city';
            }

            return 'valid';
        }

        public function validate_country($country)
        {
            if ( strlen($this->country) == 0 )
            {
                return 'Please enter a country code';
            }

            if ( strlen($this->country) > 3 )
            {
                return 'Invalid country code';
            }

            return 'valid';
        }

        public function validate_postcode($postcode)
        {
            if ( strlen($this->postcode) == 0 )
            {
                return 'Please enter a postcode';
            }
            else
            {
                $pattern = "/([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})$/";

                $match = preg_match($pattern, $postcode);
                
                if ( $match == false ) {
                    return 'Please enter a valid postcode';
                }
            }

            return 'valid';
        }

        public function validate_address_type($address_type)
        {
            if ($this->address_type != 'A' && $this->address_type != 'D' && $this->address_type != null)
            {
                return 'Please enter a A, D or leave blank';
            }

            return 'valid';
        }
    }
