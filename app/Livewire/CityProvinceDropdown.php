<?php

namespace App\Livewire;

use Livewire\Component;

class CityProvinceDropdown extends Component
{
    public $provinces;
    public $cities;
    public $selectedProvince;
    public $selectedCity;

    public function mount()
    {
        // Load provinces from a data source (e.g., database)
        $this->provinces = [
            'Abra',
            'Agusan del Norte',
            'Agusan del Sur',
            'Aklan',
            'Albay',
            'Antique',
            'Apayao',
            'Aurora',
            'Basilan',
            'Bataan',
            'Batanes',
            'Batangas',
            'Benguet',
            'Biliran',
            'Bohol',
            'Bukidnon',
            'Bulacan',
            'Cagayan',
            'Camarines Norte',
            'Camarines Sur',
            'Camiguin',
            'Capiz',
            'Catanduanes',
            'Cavite',
            'Cebu',
            'Compostela Valley',
            'Cotabato',
            'Davao del Norte',
            'Davao del Sur',
            'Davao Occidental',
            'Davao Oriental',
            'Dinagat Islands',
            'Eastern Samar',
            'Guimaras',
            'Ifugao',
            'Ilocos Norte',
            'Ilocos Sur',
            'Iloilo',
            'Isabela',
            'Kalinga',
            'La Union',
            'Laguna',
            'Lanao del Norte',
            'Lanao del Sur',
            'Leyte',
            'Maguindanao',
            'Marinduque',
            'Masbate',
            'Misamis Occidental',
            'Misamis Oriental',
            'Mountain Province',
            'Negros Occidental',
            'Negros Oriental',
            'Northern Samar',
            'Nueva Ecija',
            'Nueva Vizcaya',
            'Occidental Mindoro',
            'Oriental Mindoro',
            'Palawan',
            'Pampanga',
            'Pangasinan',
            'Quezon',
            'Quirino',
            'Rizal',
            'Romblon',
            'Samar',
            'Sarangani',
            'Siquijor',
            'Sorsogon',
            'South Cotabato',
            'Southern Leyte',
            'Sultan Kudarat',
            'Sulu',
            'Surigao del Norte',
            'Surigao del Sur',
            'Tarlac',
            'Tawi-Tawi',
            'Zambales',
            'Zamboanga del Norte',
            'Zamboanga del Sur',
            'Zamboanga Sibugay',
            // Add the 82nd province here
        ];

        // Initialize cities with the cities of the first province
        $this->selectedProvince = $this->provinces[0];
        $this->cities = $this->getCitiesByProvince($this->selectedProvince);
        $this->selectedCity = $this->cities[0];
    }

    public function render()
    {
        return view('livewire.city-province-dropdown');
    }

    public function updatedSelectedProvince($value)
    {
        $this->selectedCity = null; // Reset selected city when province changes
        $this->selectedProvince = $value; // Update selected province

        // Update cities based on the selected province
        $this->cities = $this->getCitiesByProvince($value);
    }

    private function getCitiesByProvince($province)
    {
        // Fetch cities based on the selected province from a data source (e.g., database)
        // For demonstration purposes, returning sample cities

    switch ($province) {
        case 'Abra':
            return ['Bangued', 'Boliney', 'Bucay', 'Bucloc', 'Daguioman', 'Danglas', 'Dolores', 'La Paz', 'Lacub', 'Lagangilang', 'Lagayan', 'Langiden', 'Licuan-Baay', 'Luba', 'Malibcong', 'Manabo', 'Penarrubia', 'Pidigan', 'Pilar', 'Sallapadan', 'San Isidro', 'San Juan', 'San Quintin', 'Tayum', 'Tineg', 'Tubo', 'Villaviciosa'];
        case 'Agusan del Norte':
            return ['Butuan City', 'Buenavista', 'Cabadbaran', 'Carmen', 'Jabonga', 'Kitcharao', 'Las Nieves', 'Magallanes', 'Nasipit', 'Remedios T. Romualdez', 'Santiago', 'Tubay'];
        case 'Agusan del Sur':
            return ['Bayugan City', 'Bunawan', 'Esperanza', 'La Paz', 'Loreto', 'Prosperidad', 'Rosario', 'San Francisco', 'San Luis', 'Santa Josefa', 'Sibagat', 'Talacogon', 'Trento', 'Veruela'];
        case 'Aklan':
            return ['Banga', 'Batan', 'Buruanga', 'Ibajay', 'Kalibo', 'Lezo', 'Libacao', 'Madalag', 'Makato', 'Malay', 'Malinao', 'Nabas', 'New Washington', 'Numancia', 'Tangalan'];
        case 'Albay':
            return ['Bacacay', 'Camalig', 'Daraga', 'Guinobatan', 'Jovellar', 'Legazpi City', 'Libon', 'Ligao City', 'Malilipot', 'Malinao', 'Manito', 'Oas', 'Pio Duran', 'Polangui', 'Rapu-Rapu', 'Santo Domingo (Libog)', 'Tabaco City', 'Tiwi'];
        case 'Antique':
            return ['Anini-y', 'Barbaza', 'Belison', 'Bugasong', 'Caluya', 'Culasi', 'Hamtic', 'Laua-an', 'Libertad', 'Pandan', 'Patnongon', 'San Jose', 'San Remigio', 'Sebaste', 'Sibalom', 'Tibiao', 'Tobias Fornier (Dao)', 'Valderrama'];
        case 'Apayao':
            return ['Calanasan (Bayag)', 'Conner', 'Flora', 'Kabugao (Capital)', 'Luna', 'Pudtol', 'Santa Marcela'];
        case 'Aurora':
            return ['Baler', 'Casiguran', 'Dilasag', 'Dinalungan', 'Dingalan', 'Dipaculao', 'Maria Aurora', 'San Luis'];
        case 'Basilan':
            return ['Akbar', 'Al-Barka', 'Hadji Mohammad Ajul', 'Hadji Muhtamad', 'Isabela City', 'Lamitan', 'Lantawan', 'Maluso', 'Sumisip', 'Tabuan-Lasa', 'Tipo-Tipo', 'Tuburan', 'Ungkaya Pukan'];
        case 'Bataan':
            return ['Abucay', 'Bagac', 'Balanga City', 'Dinalupihan', 'Hermosa', 'Limay', 'Mariveles', 'Morong', 'Orani', 'Orion', 'Pilar', 'Samal'];
        case 'Batanes':
            return ['Basco', 'Itbayat', 'Ivana', 'Mahatao', 'Sabtang', 'Uyugan'];
        case 'Batangas':
            return ['Agoncillo', 'Alitagtag', 'Balayan', 'Balete', 'Bauan', 'Calaca', 'Calatagan', 'Cuenca', 'Ibaan', 'Laurel', 'Lemery', 'Lian', 'Lipa City', 'Lobo', 'Mabini', 'Malvar', 'Mataasnakahoy', 'Nasugbu', 'Padre Garcia', 'Rosario', 'San Jose', 'San Juan', 'San Luis', 'San Nicolas', 'San Pascual', 'Santa Teresita', 'Santo Tomas', 'Taal', 'Talisay', 'Tanauan City', 'Taysan', 'Tingloy', 'Tuy'];
        case 'Benguet':
            return ['Atok', 'Baguio City', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan', 'La Trinidad', 'Mankayan', 'Sablan', 'Tuba', 'Tublay'];
        case 'Biliran':
            return ['Almeria', 'Biliran', 'Cabucgayan', 'Caibiran', 'Culaba', 'Kawayan', 'Maripipi', 'Naval'];
        case 'Bohol':
            return ['Alburquerque', 'Alicia', 'Anda', 'Antequera', 'Baclayon', 'Balilihan', 'Batuan', 'Bien Unido', 'Bilar', 'Buenavista', 'Calape', 'Candijay', 'Carmen', 'Catigbian', 'Clarin', 'Corella', 'Cortes', 'Dagohoy', 'Danao', 'Dauis', 'Dimiao', 'Duero', 'Garcia Hernandez', 'Getafe', 'Guindulman', 'Inabanga', 'Jagna', 'Lila', 'Loay', 'Loboc', 'Loon', 'Mabini', 'Maribojoc', 'Panglao', 'Pilar', 'President Carlos P. Garcia', 'Sagbayan (Borja)', 'San Isidro', 'San Miguel', 'Sevilla', 'Sierra Bullones', 'Sikatuna', 'Tagbilaran City', 'Talibon', 'Trinidad', 'Tubigon', 'Ubay', 'Valencia'];
        case 'Bukidnon':
            return ['Baungon', 'Cabanglasan', 'Damulog', 'Dangcagan', 'Don Carlos', 'Impasug-ong', 'Kadingilan', 'Kalilangan', 'Kibawe', 'Kitaotao', 'Lantapan', 'Libona', 'Malaybalay City', 'Malitbog', 'Manolo Fortich', 'Maramag', 'Pangantucan', 'Quezon', 'San Fernando', 'Sumilao', 'Talakag', 'Valencia City'];
        case 'Bulacan':
            return ['Angat', 'Balagtas (Bigaa)', 'Baliuag', 'Bocaue', 'Bulacan', 'Bustos', 'Calumpit', 'Doña Remedios Trinidad', 'Guiguinto', 'Hagonoy', 'Malolos City', 'Marilao', 'Meycauayan City', 'Norzagaray', 'Obando', 'Pandi', 'Paombong', 'Plaridel', 'Pulilan', 'San Ildefonso', 'San Jose del Monte City', 'San Miguel', 'San Rafael', 'Santa Maria'];
        case 'Cagayan':
            return ['Abulug', 'Alcala', 'Allacapan', 'Amulung', 'Aparri', 'Baggao', 'Ballesteros', 'Buguey', 'Calayan', 'Camalaniugan', 'Claveria', 'Enrile', 'Gattaran', 'Gonzaga', 'Iguig', 'Lal-lo', 'Lasam', 'Pamplona', 'Peñablanca', 'Piat', 'Rizal', 'Sanchez-Mira', 'Santa Ana', 'Santa Praxedes', 'Santa Teresita', 'Santo Niño (Faire)', 'Solana', 'Tuao', 'Tuguegarao City'];
        case 'Camarines Norte':
            return ['Basud', 'Capalonga', 'Daet (Capital)', 'Jose Panganiban', 'Labo', 'Mercedes', 'Paracale', 'San Lorenzo Ruiz (Imelda)', 'San Vicente', 'Santa Elena', 'Talisay', 'Vinzons'];
        case 'Camarines Sur':
            return ['Baao', 'Balatan', 'Bato', 'Bombon', 'Buhi', 'Bula', 'Cabusao', 'Calabanga', 'Camaligan', 'Canaman', 'Caramoan', 'Del Gallego', 'Gainza', 'Garchitorena', 'Goa', 'Iriga City', 'Lagonoy', 'Libmanan', 'Lupi', 'Magarao', 'Milaor', 'Minalabac', 'Nabua', 'Naga City', 'Ocampo', 'Pamplona', 'Pasacao', 'Pili (Capital)', 'Presentacion (Parubcan)', 'Ragay', 'Sagnay', 'San Fernando', 'San Jose', 'Sipocot', 'Siruma', 'Tigaon', 'Tinambac'];
        case 'Camiguin':
            return ['Catarman', 'Guinsiliban', 'Mahinog', 'Mambajao (Capital)', 'Sagay'];
        case 'Capiz':
            return ['Cuartero', 'Dao', 'Dumalag', 'Dumarao', 'Ivisan', 'Jamindan', 'Maayon', 'Mambusao', 'Panay', 'Panitan', 'Pilar', 'Pontevedra', 'President Roxas', 'Roxas City (Capital)', 'Sapi-an', 'Sigma', 'Tapaz'];
        case 'Catanduanes':
            return ['Bagamanoc', 'Baras', 'Bato', 'Caramoran', 'Gigmoto', 'Pandan', 'Panganiban (Payo)', 'San Andres (Calolbon)', 'San Miguel', 'Viga', 'Virac (Capital)'];
        case 'Cavite':
            return ['Alfonso', 'Amadeo', 'Bacoor', 'Carmona', 'Cavite City', 'Dasmariñas', 'General Emilio Aguinaldo', 'General Mariano Alvarez', 'General Trias', 'Imus', 'Indang', 'Kawit', 'Magallanes', 'Maragondon', 'Mendez-Nuñez', 'Naic', 'Noveleta', 'Rosario', 'Silang', 'Tagaytay', 'Tanza', 'Ternate', 'Trece Martires City'];
        case 'Cebu':
            return ['Alcantara', 'Alcoy', 'Alegria', 'Aloguinsan', 'Argao', 'Asturias', 'Badian', 'Balamban', 'Bantayan', 'Barili', 'Bogo City', 'Boljoon', 'Borbon', 'Carcar City', 'Carmen', 'Catmon', 'Cebu City', 'Compostela', 'Consolacion', 'Cordoba', 'Daanbantayan', 'Dalaguete', 'Danao City', 'Dumanjug', 'Ginatilan', 'Lapu-Lapu City', 'Liloan', 'Madridejos', 'Malabuyoc', 'Mandaue City', 'Medellin', 'Minglanilla', 'Moalboal', 'Naga City', 'Oslob', 'Pilar', 'Pinamungahan', 'Poro', 'Ronda', 'Samboan', 'San Fernando', 'San Francisco', 'San Remigio', 'Santa Fe', 'Santander', 'Sibonga', 'Sogod', 'Tabogon', 'Tabuelan', 'Talisay City', 'Toledo City', 'Tuburan', 'Tudela'];
        case 'Compostela Valley':
            return ['Compostela', 'Laak (San Vicente)', 'Mabini (Dona Alicia)', 'Maco', 'Maragusan (San Mariano)', 'Mawab', 'Monkayo', 'Montevista', 'Nabunturan (Capital)', 'New Bataan', 'Pantukan'];
        case 'Cotabato':
            return ['Alamada', 'Aleosan', 'Antipas', 'Arakan', 'Banisilan', 'Carmen', 'Kabacan', 'Kidapawan City (Capital)', 'Libungan', 'M\'lang', 'Magpet', 'Makilala', 'Matalam', 'Midsayap', 'Pigcawayan', 'Pikit', 'President Roxas', 'Tulunan', 'M\'lang'];
        case 'Davao del Norte':
            return ['Asuncion (Saug)', 'Braulio E. Dujali', 'Carmen', 'Kapalong', 'New Corella', 'Panabo City', 'San Isidro', 'Santo Tomas', 'Tagum City (Capital)', 'Talaingod'];
        case 'Davao del Sur':
            return ['Bansalan', 'Davao City', 'Digos City (Capital)', 'Hagonoy', 'Kiblawan', 'Magsaysay', 'Malalag', 'Matanao', 'Padada', 'Santa Cruz', 'Sulop'];
        case 'Davao Occidental':
            return ['Don Marcelino', 'Jose Abad Santos (Trinidad)', 'Malita (Dona Maria)', 'Santa Maria', 'Sarangani'];
        case 'Davao Oriental':
            return ['Baganga', 'Banaybanay', 'Boston', 'Caraga', 'Cateel', 'Governor Generoso', 'Lupon', 'Manay', 'Mati City (Capital)', 'San Isidro', 'Tarragona'];
        case 'Dinagat Islands':
            return ['Basilisa (Rizal)', 'Cagdianao', 'Dinagat', 'Libjo (Albor)', 'Loreto', 'San Jose (Capital)', 'Tubajon'];
        case 'Eastern Samar':
            return ['Arteche', 'Balangiga', 'Balangkayan', 'Borongan (Capital)', 'Can-avid', 'Dolores', 'General MacArthur', 'Giporlos', 'Guiuan', 'Hernani', 'Jipapad', 'Lawaan', 'Llorente', 'Maslog', 'Maydolong', 'Mercedes', 'Oras', 'Quinapondan', 'Salcedo', 'San Julian', 'San Policarpo', 'Sulat', 'Taft'];
        case 'Guimaras':
            return ['Buenavista', 'Jordan (Capital)', 'Nueva Valencia', 'San Lorenzo', 'Sibunag'];
        case 'Ifugao':
            return ['Aguinaldo', 'Alfonso Lista (Potia)', 'Asipulo', 'Banaue', 'Hingyon', 'Hungduan', 'Kiangan', 'Lagawe (Capital)', 'Lamut', 'Mayoyao', 'Tinoc'];
        case 'Ilocos Norte':
            return ['Adams', 'Bacarra', 'Badoc', 'Bangui', 'Banna (Espiritu)', 'Batac City', 'Burgos', 'Carasi', 'Currimao', 'Dingras', 'Dumalneg', 'Laoag City (Capital)', 'Marcos', 'Nueva Era', 'Pagudpud', 'Paoay', 'Pasuquin', 'Piddig', 'Pinili', 'San Nicolas', 'Sarrat', 'Solsona', 'Vintar'];
        case 'Ilocos Sur':
            return ['Alilem', 'Banayoyo', 'Bantay', 'Burgos', 'Cabugao', 'Candon City', 'Caoayan', 'Cervantes', 'Galimuyod', 'Gregorio Del Pilar (Concepcion)', 'Lidlidda', 'Magsingal', 'Nagbukel', 'Narvacan', 'Quirino (Angkaki)', 'Salcedo (Baugen)', 'San Emilio', 'San Esteban', 'San Ildefonso', 'San Juan (Lapog)', 'San Vicente', 'Santa', 'Santa Catalina', 'Santa Cruz', 'Santa Lucia', 'Santa Maria', 'Santiago', 'Santo Domingo', 'Sigay', 'Sinait', 'Sugpon', 'Suyo', 'Tagudin (Nalasin)', 'Vigan City (Capital)'];
        case 'Iloilo':
            return ['Ajuy', 'Alimodian', 'Anilao', 'Badiangan', 'Balasan', 'Banate', 'Barotac Nuevo', 'Barotac Viejo', 'Batad', 'Bingawan', 'Cabatuan', 'Calinog', 'Carles', 'Concepcion', 'Dingle', 'Dueñas', 'Dumangas', 'Estancia', 'Guimbal', 'Igbaras', 'Iloilo City (Capital)', 'Janiuay', 'Lambunao', 'Leganes', 'Lemery', 'Leon', 'Maasin', 'Miagao', 'Mina', 'New Lucena', 'Oton', 'Passi City', 'Pavia', 'Pototan', 'San Dionisio', 'San Enrique', 'San Joaquin', 'San Miguel', 'San Rafael', 'Santa Barbara', 'Sara', 'Tigbauan', 'Tubungan', 'Zarraga'];
        case 'Isabela':
            return ['Alicia', 'Angadanan', 'Aurora', 'Benito Soliven', 'Burgos', 'Cabagan', 'Cabatuan', 'Cordon', 'Delfin Albano (Magsaysay)', 'Dinapigue', 'Divilacan', 'Echague', 'Gamu', 'Ilagan (Capital)', 'Jones', 'Luna', 'Maconacon', 'Mallig', 'Naguilian', 'Palanan', 'Quezon', 'Quirino', 'Ramon', 'Reina Mercedes', 'Roxas', 'San Agustin', 'San Guillermo', 'San Isidro', 'San Manuel', 'San Mariano', 'San Mateo', 'San Pablo', 'Santa Maria', 'Santiago City', 'Santo Tomas', 'Tumauini'];
        case 'Kalinga':
            return ['Balbalan', 'Lubuagan', 'Pasil', 'Pinukpuk', 'Rizal (Liwan)', 'Tabuk City (Capital)', 'Tanudan', 'Tinglayan'];
        case 'La Union':
            return ['Agoo', 'Aringay', 'Bacnotan', 'Bagulin', 'Balaoan', 'Bangar', 'Bauang', 'Burgos', 'Caba', 'Luna', 'Naguilian', 'Pugo', 'Rosario', 'San Fernando City (Capital)', 'San Gabriel', 'San Juan', 'Santo Tomas', 'Santol', 'Sudipen', 'Tubao'];
        case 'Laguna':
            return ['Alaminos', 'Bay', 'Biñan City', 'Cabuyao City', 'Calamba City', 'Calauan', 'Cavinti', 'Famy', 'Kalayaan', 'Liliw', 'Los Baños', 'Luisiana', 'Lumban', 'Mabitac', 'Magdalena', 'Majayjay', 'Nagcarlan', 'Paete', 'Pagsanjan', 'Pakil', 'Pangil', 'Pila', 'Rizal', 'San Pablo City', 'San Pedro City', 'Santa Cruz (Capital)', 'Santa Maria', 'Santa Rosa City', 'Siniloan', 'Victoria'];
        case 'Lanao del Norte':
            return ['Bacolod', 'Baloi', 'Baroy', 'Kapatagan', 'Kauswagan', 'Kolambugan', 'Lala', 'Linamon', 'Magsaysay', 'Maigo', 'Matungao', 'Munai', 'Nunungan', 'Pantao Ragat', 'Pantar', 'Poona Piagapo', 'Salvador', 'Sapad', 'Sultan Naga Dimaporo (Karomatan)', 'Tagoloan', 'Tangcal', 'Tubod (Capital)'];
        case 'Lanao del Sur':
            return ['Bacolod-Kalawi (Bacolod Grande)', 'Balabagan', 'Balindong (Watu)', 'Bayang', 'Binidayan', 'Buadiposo-Buntong', 'Bubong', 'Bumbaran', 'Butig', 'Calanogas', 'Ditsaan-Ramain', 'Ganassi', 'Kapai', 'Kapatagan', 'Lumba-Bayabao (Maguing)', 'Lumbaca-Unayan', 'Lumbatan', 'Lumbayanague', 'Madalum', 'Madamba (Pagayawan)', 'Maguing', 'Malabang', 'Marantao', 'Marogong', 'Masiu', 'Mulondo', 'Pagayawan (Tatarikan)', 'Piagapo', 'Picong (Sultan Gumander)', 'Poona Bayabao (Gata)', 'Pualas', 'Saguiaran', 'Sultan Dumalondong', 'Tagoloan II', 'Tamparan', 'Taraka', 'Tubaran', 'Tugaya', 'Wao'];
        case 'Leyte':
            return ['Abuyog', 'Alangalang', 'Albuera', 'Babatngon', 'Barugo', 'Bato', 'Baybay City', 'Burauen', 'Calubian', 'Capoocan', 'Carigara', 'Dagami', 'Dulag', 'Hilongos', 'Hindang', 'Inopacan', 'Isabel', 'Jaro', 'Javier (Bugho)', 'Julita', 'Kananga', 'La Paz', 'Leyte', 'MacArthur', 'Mahaplag', 'Matag-ob', 'Matalom', 'Mayorga', 'Merida', 'Ormoc City', 'Palo', 'Palompon', 'Pastrana', 'San Isidro', 'San Miguel', 'Santa Fe', 'Tabango', 'Tabontabon', 'Tacloban City (Capital)', 'Tanauan', 'Tolosa', 'Tunga', 'Villaba'];
        case 'Maguindanao':
            return ['Ampatuan', 'Barira', 'Buldon', 'Buluan', 'Datu Abdullah Sangki', 'Datu Anggal Midtimbang', 'Datu Blah T. Sinsuat', 'Datu Hoffer Ampatuan', 'Datu Odin Sinsuat (Dinaig)', 'Datu Paglas', 'Datu Piang', 'Datu Salibo', 'Datu Saudi-Ampatuan', 'Datu Unsay', 'Gen. S. K. Pendatun', 'Guindulungan', 'Kabuntalan (Tumbao)', 'Mamasapano', 'Mangudadatu', 'Matanog', 'Northern Kabuntalan', 'Pagalungan', 'Paglat', 'Pandag', 'Parang', 'Rajah Buayan', 'Shariff Aguak (Maganoy)', 'Shariff Saydona Mustapha', 'South Upi', 'Sultan Kudarat (Nuling)', 'Sultan Mastura', 'Sultan sa Barongis (Lambayong)', 'Sultan Sumagka (Talitay)', 'Talayan', 'Talitay', 'Upi', 'Shariff Saydona Mustapha', 'Talitay', 'Tambunan', 'Tampakan', 'Tongkil'];
        case 'Marinduque':
            return ['Boac (Capital)', 'Buenavista', 'Gasan', 'Mogpog', 'Santa Cruz', 'Torrijos'];
        case 'Masbate':
            return ['Aroroy', 'Baleno', 'Balud', 'Batuan', 'Cataingan', 'Cawayan', 'Claveria', 'Dimasalang', 'Esperanza', 'Mandaon', 'Masbate City (Capital)', 'Milagros', 'Mobo', 'Monreal', 'Palanas', 'Pio V. Corpuz (Limbuhan)', 'Placer', 'San Fernando', 'San Jacinto', 'San Pascual', 'Uson'];
        case 'Misamis Occidental':
            return ['Aloran', 'Baliangao', 'Bonifacio', 'Calamba', 'Clarin', 'Concepcion', 'Don Victoriano Chiongbian (Don Mariano Marcos)', 'Jimenez', 'Lopez Jaena', 'Oroquieta City (Capital)', 'Ozamiz City', 'Panaon', 'Plaridel', 'Sapang Dalaga', 'Sinacaban', 'Tangub City', 'Tudela'];
        case 'Misamis Oriental':
            return ['Alubijid', 'Balingasag', 'Balingoan', 'Binuangan', 'Claveria', 'El Salvador City', 'Gingoog City', 'Gitagum', 'Initao', 'Jasaan', 'Kinoguitan', 'Lagonglong', 'Laguindingan', 'Libertad', 'Lugait', 'Magsaysay (Linugos)', 'Manticao', 'Medina', 'Naawan', 'Opol', 'Salay', 'Sugbongcogon', 'Tagoloan', 'Talisayan', 'Villanueva'];
        case 'Mountain Province':
            return ['Barlig', 'Bauko', 'Besao', 'Bontoc (Capital)', 'Natonin', 'Paracelis', 'Sabangan', 'Sadanga', 'Sagada', 'Tadian'];
        case 'Negros Occidental':
            return ['Bacolod City', 'Bago City', 'Binalbagan', 'Cadiz City', 'Calatrava', 'Candoni', 'Cauayan', 'Enrique B. Magalona (Saravia)', 'Escalante City', 'Himamaylan City', 'Hinigaran', 'Hinoba-an (Asia)', 'Ilog', 'Isabela', 'Kabankalan City', 'La Carlota City', 'La Castellana', 'Manapla', 'Moises Padilla (Magallon)', 'Murcia', 'Pontevedra', 'Pulupandan', 'Sagay City', 'Salvador Benedicto', 'San Carlos City', 'San Enrique', 'Silay City', 'Sipalay City', 'Talisay City', 'Toboso', 'Valladolid', 'Victorias City'];
        case 'Negros Oriental':
            return ['Amlan (Ayuquitan)', 'Ayungon', 'Bacong', 'Bais City', 'Basay', 'Bayawan City (Tulong)', 'Bindoy (Payabon)', 'Canlaon City (Diocese of Canlaon)', 'Dauin', 'Dumaguete City (Capital)', 'Guihulngan City', 'Jimalalud', 'La Libertad', 'Mabinay', 'Manjuyod', 'Pamplona', 'San Jose', 'Santa Catalina', 'Siaton', 'Sibulan', 'Tanjay City', 'Tayasan', 'Valencia (Luzurriaga)', 'Vallehermoso', 'Zamboanguita'];
        case 'Northern Samar':
            return ['Allen', 'Biri', 'Bobon', 'Capul', 'Catarman (Capital)', 'Catubig', 'Gamay', 'Laoang', 'Lapinig', 'Las Navas', 'Lavezares', 'Lope de Vega', 'Mapanas', 'Mondragon', 'Palapag', 'Pambujan', 'Rosario', 'San Antonio', 'San Isidro', 'San Jose', 'San Roque', 'San Vicente', 'Silvino Lobos', 'Victoria'];
        case 'Nueva Ecija':
            return ['Aliaga', 'Bongabon', 'Cabiao', 'Carranglan', 'Cuyapo', 'Gabaldon (Bitulok & Sabani)', 'Gapan City', 'General Mamerto Natividad', 'General Tinio (Papaya)', 'Guimba', 'Jaen', 'Laur', 'Licab', 'Llanera', 'Lupao', 'Nampicuan', 'Palayan City (Capital)', 'Pantabangan', 'Peñaranda', 'Quezon', 'Rizal', 'San Antonio', 'San Isidro', 'San Jose City', 'San Leonardo', 'Santa Rosa', 'Santo Domingo', 'Talavera', 'Talugtug', 'Zaragoza'];
        case 'Nueva Vizcaya':
            return ['Alfonso Castañeda', 'Ambaguio', 'Aritao', 'Bagabag', 'Bambang (Capital)', 'Bayombong', 'Diadi', 'Dupax del Norte', 'Dupax del Sur', 'Kasibu', 'Kayapa', 'Quezon', 'Santa Fe', 'Solano', 'Villaverde (Ibung)'];
        case 'Occidental Mindoro':
            return ['Abra de Ilog', 'Calintaan', 'Looc', 'Lubang', 'Magsaysay', 'Mamburao (Capital)', 'Paluan', 'Rizal', 'Sablayan', 'San Jose', 'Santa Cruz'];
        case 'Oriental Mindoro':
            return ['Baco', 'Bansud', 'Bongabong', 'Bulalacao (San Pedro)', 'Calapan City (Capital)', 'Gloria', 'Mansalay', 'Naujan', 'Pinamalayan', 'Pola', 'Puerto Galera', 'Roxas', 'San Teodoro', 'Socorro', 'Victoria'];
        case 'Palawan':
            return ['Aborlan', 'Agutaya', 'Araceli', 'Balabac', 'Bataraza', 'Brooke\'s Point', 'Busuanga', 'Cagayancillo', 'Coron', 'Culion', 'Cuyo', 'Dumaran', 'El Nido (Bacuit)', 'Kalayaan', 'Linapacan', 'Magsaysay', 'Narra', 'Puerto Princesa City', 'Quezon', 'Rizal (Marcos)', 'Roxas', 'San Vicente', 'Sofronio Española', 'Taytay'];
        case 'Pampanga':
            return ['Angeles City', 'Apalit', 'Arayat', 'Bacolor', 'Candaba', 'Floridablanca', 'Guagua', 'Lubao', 'Mabalacat City', 'Macabebe', 'Magalang', 'Masantol', 'Mexico', 'Minalin', 'Porac', 'San Fernando City (Capital)', 'San Luis', 'San Simon', 'Santa Ana', 'Santa Rita', 'Santo Tomas', 'Sasmuan'];
        case 'Pangasinan':
            return ['Agno', 'Aguilar', 'Alaminos City', 'Alcala', 'Anda', 'Asingan', 'Balungao', 'Bani', 'Basista', 'Bautista', 'Bayambang', 'Binalonan', 'Binmaley', 'Bolinao', 'Bugallon', 'Burgos', 'Calasiao', 'Dagupan City', 'Dasol', 'Infanta', 'Labrador', 'Laoac', 'Lingayen (Capital)', 'Mabini', 'Malasiqui', 'Manaoag', 'Mangaldan', 'Mangatarem', 'Mapandan', 'Natividad', 'Pozzorubio', 'Rosales', 'San Carlos City', 'San Fabian', 'San Jacinto', 'San Manuel', 'San Nicolas', 'San Quintin', 'Santa Barbara', 'Santa Maria', 'Santo Tomas', 'Sison', 'Sual', 'Tayug', 'Umingan', 'Urbiztondo', 'Villasis'];
        case 'Quezon':
            return ['Agdangan', 'Alabat', 'Atimonan', 'Buenavista', 'Burdeos', 'Calauag', 'Candelaria', 'Catanauan', 'Dolores', 'General Luna', 'General Nakar', 'Guinayangan', 'Gumaca', 'Infanta', 'Jomalig', 'Lopez', 'Lucban', 'Lucena City (Capital)', 'Macalelon', 'Mauban', 'Mulanay', 'Padre Burgos', 'Pagbilao', 'Panukulan', 'Patnanungan', 'Perez', 'Pitogo', 'Plaridel', 'Polillo', 'Quezon', 'Real', 'Sampaloc', 'San Andres', 'San Antonio', 'San Francisco (Aurora)', 'San Narciso', 'Sariaya', 'Tagkawayan', 'Tayabas City', 'Tiaong', 'Unisan'];
        case 'Quirino':
            return ['Aglipay', 'Cabarroguis (Capital)', 'Diffun', 'Maddela', 'Nagtipunan', 'Saguday'];
        case 'Rizal':
            return ['Angono', 'Antipolo City', 'Baras', 'Binangonan', 'Cainta', 'Cardona', 'Jalajala', 'Morong', 'Pililla', 'Rodriguez (Montalban)', 'San Mateo', 'Tanay', 'Taytay', 'Teresa'];
        case 'Romblon':
            return ['Alcantara', 'Banton (Jones)', 'Cajidiocan', 'Calatrava', 'Concepcion', 'Corcuera', 'Ferrol', 'Looc', 'Magdiwang', 'Odiongan (Capital)', 'Romblon (Capital)', 'San Agustin', 'San Andres', 'San Fernando', 'San Jose', 'Santa Fe', 'Santa Maria'];
        case 'Samar (Western Samar)':
            return ['Almagro', 'Basey', 'Calbayog City', 'Calbiga', 'Catbalogan City (Capital)', 'Daram', 'Gandara', 'Hinabangan', 'Jiabong', 'Marabut', 'Matuguinao', 'Motiong', 'Pagsanghan', 'Paranas (Wright)', 'Pinabacdao', 'San Jorge', 'San Jose de Buan', 'San Sebastian', 'Santa Margarita', 'Santa Rita', 'Santo Niño', 'Tagapul-an', 'Talalora', 'Tarangnan', 'Villareal', 'Zumarraga'];
        case 'Sarangani':
            return ['Alabel (Capital)', 'Glan', 'Kiamba', 'Maasim', 'Maitum', 'Malapatan', 'Malungon'];
        case 'Siquijor':
            return ['Enrique Villanueva', 'Larena', 'Lazi', 'Maria', 'San Juan (Cabecera)', 'Siquijor (Capital)'];
        case 'Sorsogon':
            return ['Barcelona', 'Bulan', 'Bulusan', 'Casiguran', 'Castilla', 'Donsol', 'Gubat', 'Irosin', 'Juban', 'Magallanes', 'Matnog', 'Pilar', 'Prieto Diaz', 'Santa Magdalena', 'Sorsogon City (Capital)'];
        case 'South Cotabato':
            return ['Banga', 'General Santos City (Dadiangas)', 'Koronadal City (Capital)', 'Lake Sebu', 'Norala', 'Polomolok', 'Santo Niño', 'Surallah', 'T\'boli', 'Tampakan', 'Tantangan', 'Tupi'];
        case 'Southern Leyte':
            return ['Anahawan', 'Bontoc', 'Hinunangan', 'Hinundayan', 'Libagon', 'Liloan', 'Limasawa', 'Maasin City (Capital)', 'Macrohon', 'Malitbog', 'Padre Burgos', 'Pintuyan', 'Saint Bernard', 'San Francisco', 'San Juan (Cabalian)', 'San Ricardo', 'Silago', 'Sogod', 'Tomas Oppus'];
        case 'Sultan Kudarat':
            return ['Bagumbayan', 'Columbio', 'Esperanza', 'Isulan (Capital)', 'Kalamansig', 'Lambayong (Mariano Marcos)', 'Lebak', 'Lutayan', 'Palimbang', 'President Quirino', 'Senator Ninoy Aquino', 'Tacurong City'];
        case 'Sulu':
            return ['Banguingui (Tongkil)', 'Hadji Panglima Tahil (Marunggas)', 'Indanan', 'Jolo (Capital)', 'Kalingalan Caluang', 'Lugus', 'Luuk', 'Maimbung', 'Old Panamao', 'Omar', 'Pandami', 'Panglima Estino (New Panamao)', 'Pangutaran', 'Parang', 'Pata', 'Patikul', 'Siasi', 'Talipao', 'Tapul', 'Tongkil'];
        case 'Surigao del Norte':
            return ['Alegria', 'Bacuag', 'Burgos', 'Claver', 'Dapa', 'Del Carmen', 'General Luna', 'Gigaquit', 'Mainit', 'Malimono', 'Pilar', 'Placer', 'San Benito', 'San Francisco (Anao-aon)', 'San Isidro', 'Santa Monica (Sapao)', 'Sison', 'Socorro', 'Surigao City (Capital)', 'Tagana-an', 'Tubod'];
        case 'Surigao del Sur':
            return ['Barobo', 'Bayabas', 'Cagwait', 'Cantilan', 'Carmen', 'Carrascal', 'Cortes', 'Hinatuan', 'Lanuza', 'Lianga', 'Lingig', 'Madrid', 'Marihatag', 'San Agustin', 'San Miguel', 'Tagbina', 'Tago', 'Tandag City (Capital)'];
        case 'Tarlac':
            return ['Anao', 'Bamban', 'Camiling', 'Capas', 'Concepcion', 'Gerona', 'La Paz', 'Mayantoc', 'Moncada', 'Paniqui', 'Pura', 'Ramos', 'San Clemente', 'San Jose', 'San Manuel', 'Santa Ignacia', 'Tarlac City (Capital)', 'Victoria'];
        case 'Tawi-Tawi':
            return ['Bongao (Capital)', 'Languyan', 'Mapun (Cagayan de Tawi-Tawi)', 'Panglima Sugala (Balimbing)', 'Sapa-Sapa', 'Sibutu', 'Simunul', 'Sitangkai', 'South Ubian', 'Tandubas', 'Turtle Islands'];
        case 'Zambales':
            return ['Botolan', 'Cabangan', 'Candelaria', 'Castillejos', 'Iba (Capital)', 'Masinloc', 'Olongapo City', 'Palauig', 'San Antonio', 'San Felipe', 'San Marcelino', 'San Narciso', 'Santa Cruz', 'Subic'];
        case 'Zamboanga del Norte':
            return ['Baliguian', 'Godod', 'Gutalac', 'Jose Dalman (Ponot)', 'Kalawit', 'Katipunan', 'La Libertad', 'Labason', 'Leon B. Postigo (Bacungan)', 'Liloy', 'Manukan', 'Mutia', 'Piñan (New Piñan)', 'Polanco', 'President Manuel A. Roxas', 'Rizal', 'Salug', 'Sergio Osmeña Sr.', 'Siayan', 'Sibuco', 'Sibutad', 'Sindangan', 'Siocon', 'Sirawai', 'Tampilisan'];
        case 'Zamboanga del Sur':
            return ['Aurora', 'Bayog', 'Dimataling', 'Dinas', 'Dumalinao', 'Dumingag', 'Guipos', 'Josefina', 'Kumalarang', 'Labangan', 'Lakewood', 'Lapuyan', 'Mahayag', 'Margosatubig', 'Midsalip', 'Molave', 'Pitogo', 'Ramon Magsaysay (Liargo)', 'San Miguel', 'San Pablo', 'Sominot', 'Tabina', 'Tambulig', 'Tigbao', 'Tukuran', 'Vincenzo A. Sagun'];
        case 'Zamboanga Sibugay':
            return ['Alicia', 'Buug', 'Diplahan', 'Imelda', 'Ipil (Capital)', 'Kabasalan', 'Mabuhay', 'Malangas', 'Naga', 'Olutanga', 'Payao', 'Roseller T. Lim', 'Siay', 'Talusan', 'Titay', 'Tungawan'];
        default:
            return [];
    }
}
}