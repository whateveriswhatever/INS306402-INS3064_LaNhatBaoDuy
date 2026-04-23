<?php
    require_once "model.php";
    class ProductModel extends BaseModel {
        public string $productName;

        private array $ISOCode = [
                "Afghanistan" => "AF",
                "Albania" => "AL",
                "Algeria" => "DZ",
                "America Samoa" => "AS",
                "Andorra" => "AD",
                "Angola" => "AO",
                "Anguilla" => "AI",
                "Antarctica" => "AQ",
                "Antigua and Barbuda" => "AG",
                "Argentina" => "AR",
                "Armenia" => "AM",
                "Aruba" => "AW",
                "Australia" => "AU", 
                "Austria" => "AT",
                "Azerbaijan" => "AZ",
                "Bahamas" => "BS",
                "Bahrain" => "BH",
                "Bangladesh" => "BD",
                "Barbados" => "BB",
                "Belarus" => "BY",
                "Belgium" => "BE",
                "Belize" => "BZ",
                "Benin" => "BJ",
                "Bermuda" => "BM",
                "Bhutan" => "BT",
                "Bolivia" => "BO",
                "Bosnia and Herzegovina" => "BA",
                "Bostwana" => "BW",
                "Brazil" => "BR",
                "British Indian Ocean Territory" => "IO",
                "British Virgin Island" => "VG",
                "Brunei" => "BN",
                "Bulgaria" => "BG",
                "Burkina Faso" => "BF",
                "Burundi" => "BI",
                "Cambodia" => "KH",
                "Cameroon" => "CM",
                "Canada" => "CA",
                "Cape Verde" => "CV",
                "Cayman Islands" => "KY",
                "Central African Republic" => "CF",
                "Chad" => "TD",
                "Chile" => "CL",
                "China" => "CN",
                "Christmas Island" => "CX",
                "Cocos Islands" => "CC",
                "Colombia" => "CO",
                "Comoros" => "KM",
                "Cook Islands" => "CK",
                "Costa Rica" => "CR",
                "Croatia" => "HR",
                "Cuba" => "CU",
                "Curacao" => "CW",
                "Cyprus" => "CY",
                "Czech Republic" => "CZ",
                "Democratic Republic of the Congo" => "CD",
                "Demark" => "DK",
                "Djibouti" => "DJ",
                "Dominica" => "DM",
                "Dominican Republic" => "DO",
                "East Timor" => "TL",
                "Ecuador" => "EC",
                "Egypt" => "EG",
                "El Salvador" => "SV",
                "Equatorial Guinea" => "GQ",
                "Eritrea" => "ER",
                "Estonia" => "EE",
                "Ethiopia" => "ET",
                "Falkland Islands" => "FK",
                "Faroe Islands" => "FO",
                "Fiji" => "FJ",
                "Finland" => "FI",
                "France" => "FR",
                "French Polynesia" => "PF",
                "Gabon" => "GA",
                "Gambia" => "GA",
                "Georgia" => "GE",
                "Germany" => "DE",
                "Ghana" => "GH",
                "Gibralta" => "GI",
                "Greece" => "GR",
                "Greenland" => "GL",
                "Grenada" => "GD",
                "Guam" => "GU",
                "Guatemala" => "GT",
                "Guernsey" => "GG",
                "Guinea" => "GN",
                "Guinea-Bissau" => "GW",
                "Guyana" => "GY",
                "Haiti" => "HT",
                "Honduras" => "HN",
                "Hong Kong" => "HK",
                "Hungary" => "HU",
                "Iceland" => "IS",
                "India" => "IN",
                "Indonesia" => "ID",
                "Iran" => "IR",
                "Iraq" => "IQ",
                "Ireland" => "IE",
                "Isle of Man" => "IM",
                "Israel" => "IL",
                "Italy" => "IT",
                "Ivory Coast" => "CI",
                "Jamaica" => "JM",
                "Japan" => "JP",
                "Jersey" => "JE",
                "Jordan" => "JO",
                "Kazakhstan" => "KZ",
                "Kenya" => "KE",
                "Kiribati" => "KI",
                "Kosovo" => "XK",
                "Kuwait" => "KW",
                "Kyrgyzstan" => "KG",
                "Laos" => "LA",
                "Latvia" => "LV",
                "Lebanon" => "LB",
                "Lesotho" => "LS",
                "Liberia" => "LR",
                "Libya" => "LY",
                "Liechtenstein" => "LI",
                "Lithuania" => "LT",
                "Luxembourg" => "LU",
                "Macau" => "MO",
                "Macedonia" => "MK",
                "Madagascar" => "MG",
                "Malawi" => "MW",
                "Malaysia" => "MY",
                "Maldives" => "MV",
                "Mali" => "ML",
                "Malta" => "MT",
                "Marshall Island" => "MH",
                "Mauritania" => "MR",
                "Mauritius" => "MU",
                "Mayotte" => "YT",
                "Mexico" => "MX",
                "Micronesia" => "FM",
                "Moldova" => "MD",
                "Monaco" => "MC",
                "Mongolia" => "MN",
                "Montenegro" => "ME",
                "Montserrat" => "MS",
                "Moroco" => "MA",
                "Mozambique" => "MZ",
                "Myanmar" => "MM",
                "Namibia" => "NA",
                "Nauru" => "NR",
                "Nepal" => "NP",
                "Netherlands" => "NL",
                "Netherlands Antilles" => "AN",
                "New Caledonia" => "NC",
                "New Zealand" => "NZ",
                "Nicaragua" => "NI",
                "Niger" => "NE",
                "Nigeria" => "NG",
                "Niue" => "NU",
                "North Korea" => "KP",
                "Northern Mariana Island" => "MP",
                "Norway" => "NO",
                "Oman" => "OM",
                "Pakistan" => "PK",
                "Palau" => "PW",
                "Palestine" => "PS",
                "Panama" => "PA",
                "Papua New Guinea" => "PG",
                "Paraguay" => "PY",
                "Peru" => "PE",
                "Philippines" => "PH",
                "Pitcairn" => "PN",
                "Poland" => "PL",
                "Portugal" => "PT",
                "Puerto Rico" => "PR",
                "Qatar" => "QA",
                "Republic of the Congo" => "CG",
                "Reunion" => "RE",
                "Romania" => "RO",
                "Russia" => "RU",
                "Rwanda" => "RW",
                "Saint Barthelemy" => "BL",
                "Saint Helena" => "SH",
                "Saint Kitts and Nevis" => "KN",
                "Saint Lucia" => "LC",
                "Saint Martin" => "MF",
                "Saint Pierre and Miquelon" => "PM",
                "Saint Vincent and the Grenadines" => "VC",
                "Samoa" => "WS",
                "San Marino" => "SM",
                "Sao Tome and Principe" => "ST",
                "Saudi Arabia" => "SA",
                "Senegal" => "SN",
                "Serbia" => "RS",
                "Seychelles" => "SC",
                "Sierra Leone" => "SL",
                "Singapore" => "SG",
                "Sint Maarten" => "SX",
                "Slovakia" => "SK",
                "Slovenia" => "SI",
                "Solomon Islands" => "SB",
                "Somalia" => "SO",
                "South Africa" => "ZA",
                "South Korea" => "KR",
                "South Sudan" => "SS",
                "Spain" => "ES",
                "Sri Lanka" => "LK",
                "Sudan" => "SD",
                "Suriname" => "SR",
                "Svalbard and Jan Mayen" => "SJ",
                "Swaziland" => "SZ",
                "Sweeden" => "SE",
                "Switzerland" => "CH",
                "Syria" => "SY",
                "Taiwan" => "TW",
                "Tajikistan" => "TJ",
                "Tanzania" => "TZ",
                "Thailand" => "TH",
                "Togo" => "TG",
                "Tokelau" => "TK",
                "Tonga" => "TO",
                "Trinidad and Tobago" => "TT",
                "Tunisia" => "TN",
                "Turkey" => "TR",
                "Turkmenistan" => "TM",
                "Turks and Caicos Islands" => "TC",
                "Tuvalu" => "TV",
                "U.S. Virgin Islands" => "VI",
                "Uganda" => "UG",
                "Ukraine" => "UA",
                "United Arab Emirates" => "AE",
                "United Kingdom" => "GB",
                "United States" => "US",
                "Uruguay" => "UY",
                "Uzbekistan" => "UZ",
                "Vanuatu" => "VU",
                "Vatican" => "VA",
                "Venezuela" => "VE",
                "Vietnam" => "VN",
                "Wallis and Futuna" => "WF",
                "Western Sahara" => "EH",
                "Yemen" => "YE",
                "Zambia" => "ZM",
                "Zimbabwe" => "ZW"  
            ];

        public function __construct(string $tableName) {
            parent::__construct($tableName);
        }

        private function isContainSpecialChars(string $str): bool {
            // \p{L}: Khớp với bất kỳ chữ cái nào từ bất kỳ ngôn ngữ nào (có dấu hoặc không)
            // \p{N}: Khớp với bất kỳ con số nào
            // \s: Khớp với khoảng trắng (dấu cách, tab, xuống dòng)
            // Modifier /u: Bắt buộc phải có để PHP hiểu chuỗi theo chuẩn UTF-8
            // if (preg_match("/[^a-zA-Z0-9]/", $str)) return true;
            if (preg_match("/[^\p{L}\p{N}\s]/u", $str)) return true;
            return false;
        }

        private function cleanWhiteSpace(string $str): string {
            // \s+ : tìm tất cả các cụm khoảng trắng (dấu cách, tab, xuống dòng) có 1 hoặc nhiều ký tự
            // " " : thay thế cụm đó bằng duy nhất 1 dấu cách bình thường
            // /u : đảm bảo xử lý đúng chuẩn Unicode
            $str = preg_replace("/\s+/u", " ", $str);
            return trim($str);
        }

        private function exchangeISOCode(string $country): string {
            if (!isset($this->ISOCode[$country])) {
                return "";
            }
            return $this->ISOCode[$country];
        }

        public function validate($data): bool {
            if (empty($data)) return false;
            echo "<div>validating data...</div>";
            // echo "<div>received data: {$data}</div>";
            
            $name = $data["name"];
            $category = $data["category"];
            $quantity = (int)$data["quantity"];
            $origin = $data["origin"];
            $distributor = $data["distributor"];
            $company = $data["from_company"];
            $manufuctured_date = $data["manufactured_date"];
            $expired_date = $data["expired_date"];

            $arr = [$name, $category, $quantity, $origin, $distributor, $company, $manufuctured_date, $expired_date];
            foreach ($arr as $each) {
                echo "<div>{$each}</div>";
            }
            

            if ($this->isContainSpecialChars($name)
                || $this->isContainSpecialChars($category) 
                || $this->isContainSpecialChars($origin)) {echo "<div>Data input contains special chars</div>";return false;}
            echo gettype($quantity);
            if ($quantity < 0 || gettype($quantity) !== "integer") {echo "<div>Quantity data type must be integer</div>";return false;}
            if (!isset($this->ISOCode[$origin])) {echo "<div>ISO country code not found!</div>";return false;}
    
            return true;

        }

        public function add($data): bool {
            $isDataValidated = $this->validate($data);
            if (!$isDataValidated) {echo "<div>Data is invalid to add</div>";return false;}
            $data["origin"] = $this->ISOCode[$data["origin"]];
            $tableName = parent::getTableName();
            $keys = array_keys($data);
            $vals = array_values($data);
            $bindingParams = implode(" , ", array_map(function($key) {
                return ":{$key}";
            }, $keys));
            $insertedCols = implode(" , ", array_map(function($key) {
                return "{$key}";
            }, $keys));
            $query = "
                insert into
                {$tableName} ($insertedCols)
                values ({$bindingParams})
            ";
            echo "<div>{$query}</div>";
            $params = [];
            for ($i = 0; $i < count($keys); $i++) {
                $params[":{$keys[$i]}"] = $vals[$i];
            }
            $pdo = parent::getDBConnection();
            // $stmt = (parent::getDBConnection())->prepare($query);
            $stmt = $pdo->prepare($query);
            if ($stmt->execute($params)) {
                // Success
                echo "<div>Added a new product!</div>";
                return true;
            } else {
                // Failure
                echo "<div>Failed to add new product!</div>";
                return false;
            }
        }

        public function update(array $new_data): bool {
            /* <?=  ?> works in HTML/PHP templates, not inside strings
                Inside string, only variable interpolation "$var" or concatenation works */
            $isDataValidated = $this->validate($new_data);
            if (!$isDataValidated) return false;
            $currId = $new_data["id"];
            if ($currId < 1) return false;
            $new_data["origin"] = $this->ISOCode[$new_data["origin"]];
            echo "<div>Equivalent ISO code: {$new_data['origin']}</div>";
            $tableName = parent::getTableName();
            $keys = array_keys($new_data);
            $vals = array_values($new_data);
            $bindingParams = array_map(function($key) {return ":$key";}, $keys);
            /*
                update table products
                set name = :name, origin = :origin,...
                where id = :id
             */
            $bindingParams = implode(" , ", array_map(function ($key) {return "$key = :$key";}, $keys));  
            $query = "
                update $tableName
                set $bindingParams
                where id = $currId";
            $params = [];
            for ($i = 0; $i < count($keys); $i++) {
                $params[$keys[$i]] = $vals[$i];
            }
            $pdo = parent::getDBConnection();
            $stmt = $pdo->prepare($query);
            if ($stmt->execute($params)) {
                echo "<div>Updated product ID: $currId</div>";
                return true;
            } else {
                echo "<div>Failed to update product ID: $currId</div>";
                return false;
            }
            
        }
    }
?>