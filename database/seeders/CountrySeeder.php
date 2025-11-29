<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = collect(
            [
            [
                "name" => "Bahrain",
                "country_code" => "BH",
                "phone_code" => "+973",
                "phone_digits" => "8",
                "is_active" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saudi Arabia",
                "country_code" => "SA",
                "phone_code" => "+966",
                "phone_digits" => "9",
                "is_active" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "United Arab Emirates",
                "country_code" => "AE",
                "phone_code" => "+971",
                "phone_digits" => "9",
                "is_active" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Pakistan",
                "country_code" => "PK",
                "phone_code" => "+92",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kuwait",
                "country_code" => "KW",
                "phone_code" => "+965",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Afghanistan",
                "country_code" => "AF",
                "phone_code" => "+93",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Aland Islands",
                "country_code" => "AX",
                "phone_code" => "+358",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Albania",
                "country_code" => "AL",
                "phone_code" => "+355",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Algeria",
                "country_code" => "DZ",
                "phone_code" => "+213",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "American Samoa",
                "country_code" => "AS",
                "phone_code" => "+1684",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Andorra",
                "country_code" => "AD",
                "phone_code" => "+376",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Angola",
                "country_code" => "AO",
                "phone_code" => "+244",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Anguilla",
                "country_code" => "AI",
                "phone_code" => "+1264",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Antarctica",
                "country_code" => "AQ",
                "phone_code" => "+672",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Antigua and Barbuda",
                "country_code" => "AG",
                "phone_code" => "+1268",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Argentina",
                "country_code" => "AR",
                "phone_code" => "+54",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Armenia",
                "country_code" => "AM",
                "phone_code" => "+374",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Aruba",
                "country_code" => "AW",
                "phone_code" => "+297",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ascension Island",
                "country_code" => "AC",
                "phone_code" => "+247",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Australia",
                "country_code" => "AU",
                "phone_code" => "+61",
                "phone_digits" => "15",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Austria",
                "country_code" => "AT",
                "phone_code" => "+43",
                "phone_digits" => "13",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Azerbaijan",
                "country_code" => "AZ",
                "phone_code" => "+994",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bahamas",
                "country_code" => "BS",
                "phone_code" => "+1242",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bangladesh",
                "country_code" => "BD",
                "phone_code" => "+880",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Barbados",
                "country_code" => "BB",
                "phone_code" => "+1246",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Belarus",
                "country_code" => "BY",
                "phone_code" => "+375",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Belgium",
                "country_code" => "BE",
                "phone_code" => "+32",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Belize",
                "country_code" => "BZ",
                "phone_code" => "+501",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Benin",
                "country_code" => "BJ",
                "phone_code" => "+229",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bermuda",
                "country_code" => "BM",
                "phone_code" => "+1441",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bhutan",
                "country_code" => "BT",
                "phone_code" => "+975",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bolivia",
                "country_code" => "BO",
                "phone_code" => "+591",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bosnia and Herzegovina",
                "country_code" => "BA",
                "phone_code" => "+387",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Botswana",
                "country_code" => "BW",
                "phone_code" => "+267",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Brazil",
                "country_code" => "BR",
                "phone_code" => "+55",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "British Indian Ocean Territory",
                "country_code" => "IO",
                "phone_code" => "+246",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Brunei Darussalam",
                "country_code" => "BN",
                "phone_code" => "+673",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Bulgaria",
                "country_code" => "BG",
                "phone_code" => "+359",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Burkina Faso",
                "country_code" => "BF",
                "phone_code" => "+226",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Burundi",
                "country_code" => "BI",
                "phone_code" => "+257",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cambodia",
                "country_code" => "KH",
                "phone_code" => "+855",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cameroon",
                "country_code" => "CM",
                "phone_code" => "+237",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Canada",
                "country_code" => "CA",
                "phone_code" => "+1",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cape Verde",
                "country_code" => "CV",
                "phone_code" => "+238",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cayman Islands",
                "country_code" => "KY",
                "phone_code" => "+1345",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Central African Republic",
                "country_code" => "CF",
                "phone_code" => "+236",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Chad",
                "country_code" => "TD",
                "phone_code" => "+235",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Chile",
                "country_code" => "CL",
                "phone_code" => "+56",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "China",
                "country_code" => "CN",
                "phone_code" => "+86",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Christmas Island",
                "country_code" => "CX",
                "phone_code" => "+61",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cocos (Keeling) Islands",
                "country_code" => "CC",
                "phone_code" => "+61",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Colombia",
                "country_code" => "CO",
                "phone_code" => "+57",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Comoros",
                "country_code" => "KM",
                "phone_code" => "+269",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Republic of the Congo",
                "country_code" => "CG",
                "phone_code" => "+242",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cook Islands",
                "country_code" => "CK",
                "phone_code" => "+682",
                "phone_digits" => "5",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Costa Rica",
                "country_code" => "CR",
                "phone_code" => "+506",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Croatia",
                "country_code" => "HR",
                "phone_code" => "+385",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cuba",
                "country_code" => "CU",
                "phone_code" => "+53",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Cyprus",
                "country_code" => "CY",
                "phone_code" => "+357",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Czech Republic",
                "country_code" => "CZ",
                "phone_code" => "+420",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Democratic Republic of the Congo",
                "country_code" => "CD",
                "phone_code" => "+243",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Denmark",
                "country_code" => "DK",
                "phone_code" => "+45",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Djibouti",
                "country_code" => "DJ",
                "phone_code" => "+253",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Dominica",
                "country_code" => "DM",
                "phone_code" => "+1767",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Dominican Republic",
                "country_code" => "DO",
                "phone_code" => "+1849",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ecuador",
                "country_code" => "EC",
                "phone_code" => "+593",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Egypt",
                "country_code" => "EG",
                "phone_code" => "+20",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "El Salvador",
                "country_code" => "SV",
                "phone_code" => "+503",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Equatorial Guinea",
                "country_code" => "GQ",
                "phone_code" => "+240",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Eritrea",
                "country_code" => "ER",
                "phone_code" => "+291",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Estonia",
                "country_code" => "EE",
                "phone_code" => "+372",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Eswatini",
                "country_code" => "SZ",
                "phone_code" => "+268",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ethiopia",
                "country_code" => "ET",
                "phone_code" => "+251",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Falkland Islands (Malvinas)",
                "country_code" => "FK",
                "phone_code" => "+500",
                "phone_digits" => "5",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Faroe Islands",
                "country_code" => "FO",
                "phone_code" => "+298",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Fiji",
                "country_code" => "FJ",
                "phone_code" => "+679",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Finland",
                "country_code" => "FI",
                "phone_code" => "+358",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "France",
                "country_code" => "FR",
                "phone_code" => "+33",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "French Guiana",
                "country_code" => "GF",
                "phone_code" => "+594",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "French Polynesia",
                "country_code" => "PF",
                "phone_code" => "+689",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Gabon",
                "country_code" => "GA",
                "phone_code" => "+241",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Gambia",
                "country_code" => "GM",
                "phone_code" => "+220",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Georgia",
                "country_code" => "GE",
                "phone_code" => "+995",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Germany",
                "country_code" => "DE",
                "phone_code" => "+49",
                "phone_digits" => "13",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ghana",
                "country_code" => "GH",
                "phone_code" => "+233",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Gibraltar",
                "country_code" => "GI",
                "phone_code" => "+350",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Greece",
                "country_code" => "GR",
                "phone_code" => "+30",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Greenland",
                "country_code" => "GL",
                "phone_code" => "+299",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Grenada",
                "country_code" => "GD",
                "phone_code" => "+1473",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guadeloupe",
                "country_code" => "GP",
                "phone_code" => "+590",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guam",
                "country_code" => "GU",
                "phone_code" => "+1671",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guatemala",
                "country_code" => "GT",
                "phone_code" => "+502",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guernsey",
                "country_code" => "GG",
                "phone_code" => "+44",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guinea",
                "country_code" => "GN",
                "phone_code" => "+224",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guinea-Bissau",
                "country_code" => "GW",
                "phone_code" => "+245",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Guyana",
                "country_code" => "GY",
                "phone_code" => "+592",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Haiti",
                "country_code" => "HT",
                "phone_code" => "+509",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Holy See (Vatican City State)",
                "country_code" => "VA",
                "phone_code" => "+379",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Honduras",
                "country_code" => "HN",
                "phone_code" => "+504",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Hong Kong",
                "country_code" => "HK",
                "phone_code" => "+852",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Hungary",
                "country_code" => "HU",
                "phone_code" => "+36",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Iceland",
                "country_code" => "IS",
                "phone_code" => "+354",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "India",
                "country_code" => "IN",
                "phone_code" => "+91",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Indonesia",
                "country_code" => "ID",
                "phone_code" => "+62",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Iran",
                "country_code" => "IR",
                "phone_code" => "+98",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Iraq",
                "country_code" => "IQ",
                "phone_code" => "+964",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ireland",
                "country_code" => "IE",
                "phone_code" => "+353",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Isle of Man",
                "country_code" => "IM",
                "phone_code" => "+44",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Israel",
                "country_code" => "IL",
                "phone_code" => "+972",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Italy",
                "country_code" => "IT",
                "phone_code" => "+39",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ivory Coast / Cote d'Ivoire",
                "country_code" => "CI",
                "phone_code" => "+225",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Jamaica",
                "country_code" => "JM",
                "phone_code" => "+1876",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Japan",
                "country_code" => "JP",
                "phone_code" => "+81",
                "phone_digits" => "13",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Jersey",
                "country_code" => "JE",
                "phone_code" => "+44",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Jordan",
                "country_code" => "JO",
                "phone_code" => "+962",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kazakhstan",
                "country_code" => "KZ",
                "phone_code" => "+77",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kenya",
                "country_code" => "KE",
                "phone_code" => "+254",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kiribati",
                "country_code" => "KI",
                "phone_code" => "+686",
                "phone_digits" => "5",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Korea, Democratic People's Republic of Korea",
                "country_code" => "KP",
                "phone_code" => "+850",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Korea, Republic of South Korea",
                "country_code" => "KR",
                "phone_code" => "+82",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kosovo",
                "country_code" => "XK",
                "phone_code" => "+383",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Kyrgyzstan",
                "country_code" => "KG",
                "phone_code" => "+996",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Laos",
                "country_code" => "LA",
                "phone_code" => "+856",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Latvia",
                "country_code" => "LV",
                "phone_code" => "+371",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Lebanon",
                "country_code" => "LB",
                "phone_code" => "+961",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Lesotho",
                "country_code" => "LS",
                "phone_code" => "+266",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Liberia",
                "country_code" => "LR",
                "phone_code" => "+231",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Libya",
                "country_code" => "LY",
                "phone_code" => "+218",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Liechtenstein",
                "country_code" => "LI",
                "phone_code" => "+423",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Lithuania",
                "country_code" => "LT",
                "phone_code" => "+370",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Luxembourg",
                "country_code" => "LU",
                "phone_code" => "+352",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Macao",
                "country_code" => "MO",
                "phone_code" => "+853",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Madagascar",
                "country_code" => "MG",
                "phone_code" => "+261",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Malawi",
                "country_code" => "MW",
                "phone_code" => "+265",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Malaysia",
                "country_code" => "MY",
                "phone_code" => "+60",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Maldives",
                "country_code" => "MV",
                "phone_code" => "+960",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mali",
                "country_code" => "ML",
                "phone_code" => "+223",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Malta",
                "country_code" => "MT",
                "phone_code" => "+356",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Marshall Islands",
                "country_code" => "MH",
                "phone_code" => "+692",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Martinique",
                "country_code" => "MQ",
                "phone_code" => "+596",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mauritania",
                "country_code" => "MR",
                "phone_code" => "+222",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mauritius",
                "country_code" => "MU",
                "phone_code" => "+230",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mayotte",
                "country_code" => "YT",
                "phone_code" => "+262",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mexico",
                "country_code" => "MX",
                "phone_code" => "+52",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Micronesia, Federated States of Micronesia",
                "country_code" => "FM",
                "phone_code" => "+691",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Moldova",
                "country_code" => "MD",
                "phone_code" => "+373",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Monaco",
                "country_code" => "MC",
                "phone_code" => "+377",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mongolia",
                "country_code" => "MN",
                "phone_code" => "+976",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Montenegro",
                "country_code" => "ME",
                "phone_code" => "+382",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Montserrat",
                "country_code" => "MS",
                "phone_code" => "+1664",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Morocco",
                "country_code" => "MA",
                "phone_code" => "+212",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Mozambique",
                "country_code" => "MZ",
                "phone_code" => "+258",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Myanmar",
                "country_code" => "MM",
                "phone_code" => "+95",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Namibia",
                "country_code" => "NA",
                "phone_code" => "+264",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Nauru",
                "country_code" => "NR",
                "phone_code" => "+674",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Nepal",
                "country_code" => "NP",
                "phone_code" => "+977",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Netherlands",
                "country_code" => "NL",
                "phone_code" => "+31",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Netherlands Antilles",
                "country_code" => "AN",
                "phone_code" => "+599",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "New Caledonia",
                "country_code" => "NC",
                "phone_code" => "+687",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "New Zealand",
                "country_code" => "NZ",
                "phone_code" => "+64",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Nicaragua",
                "country_code" => "NI",
                "phone_code" => "+505",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Niger",
                "country_code" => "NE",
                "phone_code" => "+227",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Nigeria",
                "country_code" => "NG",
                "phone_code" => "+234",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Niue",
                "country_code" => "NU",
                "phone_code" => "+683",
                "phone_digits" => "4",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Norfolk Island",
                "country_code" => "NF",
                "phone_code" => "+672",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "North Macedonia",
                "country_code" => "MK",
                "phone_code" => "+389",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Northern Mariana Islands",
                "country_code" => "MP",
                "phone_code" => "+1670",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Norway",
                "country_code" => "NO",
                "phone_code" => "+47",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Oman",
                "country_code" => "OM",
                "phone_code" => "+968",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Palau",
                "country_code" => "PW",
                "phone_code" => "+680",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Palestine",
                "country_code" => "PS",
                "phone_code" => "+970",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Panama",
                "country_code" => "PA",
                "phone_code" => "+507",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Papua New Guinea",
                "country_code" => "PG",
                "phone_code" => "+675",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Paraguay",
                "country_code" => "PY",
                "phone_code" => "+595",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Peru",
                "country_code" => "PE",
                "phone_code" => "+51",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Philippines",
                "country_code" => "PH",
                "phone_code" => "+63",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Pitcairn",
                "country_code" => "PN",
                "phone_code" => "+872",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Poland",
                "country_code" => "PL",
                "phone_code" => "+48",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Portugal",
                "country_code" => "PT",
                "phone_code" => "+351",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Puerto Rico",
                "country_code" => "PR",
                "phone_code" => "+1939",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Qatar",
                "country_code" => "QA",
                "phone_code" => "+974",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Reunion",
                "country_code" => "RE",
                "phone_code" => "+262",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Romania",
                "country_code" => "RO",
                "phone_code" => "+40",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Russia",
                "country_code" => "RU",
                "phone_code" => "+7",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Rwanda",
                "country_code" => "RW",
                "phone_code" => "+250",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Barthelemy",
                "country_code" => "BL",
                "phone_code" => "+590",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Helena, Ascension and Tristan Da Cunha",
                "country_code" => "SH",
                "phone_code" => "+290",
                "phone_digits" => "4",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Kitts and Nevis",
                "country_code" => "KN",
                "phone_code" => "+1869",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Lucia",
                "country_code" => "LC",
                "phone_code" => "+1758",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Martin",
                "country_code" => "MF",
                "phone_code" => "+590",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Pierre and Miquelon",
                "country_code" => "PM",
                "phone_code" => "+508",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Saint Vincent and the Grenadines",
                "country_code" => "VC",
                "phone_code" => "+1784",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Samoa",
                "country_code" => "WS",
                "phone_code" => "+685",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "San Marino",
                "country_code" => "SM",
                "phone_code" => "+378",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sao Tome and Principe",
                "country_code" => "ST",
                "phone_code" => "+239",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Senegal",
                "country_code" => "SN",
                "phone_code" => "+221",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Serbia",
                "country_code" => "RS",
                "phone_code" => "+381",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Seychelles",
                "country_code" => "SC",
                "phone_code" => "+248",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sierra Leone",
                "country_code" => "SL",
                "phone_code" => "+232",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Singapore",
                "country_code" => "SG",
                "phone_code" => "+65",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sint Maarten",
                "country_code" => "SX",
                "phone_code" => "+1721",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Slovakia",
                "country_code" => "SK",
                "phone_code" => "+421",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Slovenia",
                "country_code" => "SI",
                "phone_code" => "+386",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Solomon Islands",
                "country_code" => "SB",
                "phone_code" => "+677",
                "phone_digits" => "5",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Somalia",
                "country_code" => "SO",
                "phone_code" => "+252",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "South Africa",
                "country_code" => "ZA",
                "phone_code" => "+27",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "South Georgia and the South Sandwich Islands",
                "country_code" => "GS",
                "phone_code" => "+500",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "South Sudan",
                "country_code" => "SS",
                "phone_code" => "+211",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Spain",
                "country_code" => "ES",
                "phone_code" => "+34",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sri Lanka",
                "country_code" => "LK",
                "phone_code" => "+94",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sudan",
                "country_code" => "SD",
                "phone_code" => "+249",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Suriname",
                "country_code" => "SR",
                "phone_code" => "+597",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Svalbard and Jan Mayen",
                "country_code" => "SJ",
                "phone_code" => "+47",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Sweden",
                "country_code" => "SE",
                "phone_code" => "+46",
                "phone_digits" => "13",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Switzerland",
                "country_code" => "CH",
                "phone_code" => "+41",
                "phone_digits" => "12",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Syrian Arab Republic",
                "country_code" => "SY",
                "phone_code" => "+963",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Taiwan",
                "country_code" => "TW",
                "phone_code" => "+886",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tajikistan",
                "country_code" => "TJ",
                "phone_code" => "+992",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tanzania, United Republic of Tanzania",
                "country_code" => "TZ",
                "phone_code" => "+255",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Thailand",
                "country_code" => "TH",
                "phone_code" => "+66",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Timor-Leste",
                "country_code" => "TL",
                "phone_code" => "+670",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Togo",
                "country_code" => "TG",
                "phone_code" => "+228",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tokelau",
                "country_code" => "TK",
                "phone_code" => "+690",
                "phone_digits" => "4",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tonga",
                "country_code" => "TO",
                "phone_code" => "+676",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Trinidad and Tobago",
                "country_code" => "TT",
                "phone_code" => "+1868",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tunisia",
                "country_code" => "TN",
                "phone_code" => "+216",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Turkey",
                "country_code" => "TR",
                "phone_code" => "+90",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Turkmenistan",
                "country_code" => "TM",
                "phone_code" => "+993",
                "phone_digits" => "8",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Turks and Caicos Islands",
                "country_code" => "TC",
                "phone_code" => "+1649",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Tuvalu",
                "country_code" => "TV",
                "phone_code" => "+688",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Uganda",
                "country_code" => "UG",
                "phone_code" => "+256",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Ukraine",
                "country_code" => "UA",
                "phone_code" => "+380",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "United Kingdom",
                "country_code" => "GB",
                "phone_code" => "+44",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "United States",
                "country_code" => "US",
                "phone_code" => "+1",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Uruguay",
                "phone_code" => "+598",
                "country_code" => "UY",
                "phone_digits" => "11",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Uzbekistan",
                "country_code" => "UZ",
                "phone_code" => "+998",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Vanuatu",
                "country_code" => "VU",
                "phone_code" => "+678",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Venezuela, Bolivarian Republic of Venezuela",
                "country_code" => "VE",
                "phone_code" => "+58",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Vietnam",
                "country_code" => "VN",
                "phone_code" => "+84",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Virgin Islands, British",
                "country_code" => "VG",
                "phone_code" => "+1284",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Virgin Islands, U.S.",
                "country_code" => "VI",
                "phone_code" => "+1340",
                "phone_digits" => "7",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Wallis and Futuna",
                "country_code" => "WF",
                "phone_code" => "+681",
                "phone_digits" => "6",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Yemen",
                "country_code" => "YE",
                "phone_code" => "+967",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Zambia",
                "country_code" => "ZM",
                "phone_code" => "+260",
                "phone_digits" => "9",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Zimbabwe",
                "country_code" => "ZW",
                "phone_code" => "+263",
                "phone_digits" => "10",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
        $countries->map(function($country){
            Country::create($country);
        });

    }
}
