<?php
// database/seeders/TeamSeeder.php
namespace Database\Seeders;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        $teams = [
            // --- Premier League (division_id = 1) ---
            ['Manchester United', 1, 'logos/England - Premier League/Manchester United.png', 'Old Trafford, Manchester', '#DA291C', '#FBE122'],
            ['Arsenal', 1, 'https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg', 'Emirates Stadium, London', '#EF0107', '#023474'],
            ['Manchester City', 1, 'https://upload.wikimedia.org/wikipedia/en/e/eb/Manchester_City_FC_badge.svg', 'Etihad Stadium, Manchester', '#6CABDD', '#1C2C5B'],
            ['Liverpool', 1, 'https://upload.wikimedia.org/wikipedia/en/0/0c/Liverpool_FC.svg', 'Anfield, Liverpool', '#C8102E', '#00B2A9'],
            ['Chelsea', 1, 'https://upload.wikimedia.org/wikipedia/en/c/cc/Chelsea_FC.svg', 'Stamford Bridge, London', '#034694', '#FFFFFF'],
            ['Tottenham Hotspur', 1, 'https://upload.wikimedia.org/wikipedia/en/b/b4/Tottenham_Hotspur.svg', 'Tottenham Hotspur Stadium', '#132257', '#FFFFFF'],
            ['Newcastle United', 1, 'https://upload.wikimedia.org/wikipedia/en/5/56/Newcastle_United_Logo.svg', 'St. James’ Park, Newcastle', '#241F20', '#FFFFFF'],
            ['Aston Villa', 1, 'logos/England - Premier League/Aston Villa.png', 'Villa Park, Birmingham', '#670E36', '#95BFE5'],
            ['Brighton', 1, 'https://upload.wikimedia.org/wikipedia/en/f/fd/Brighton_%26_Hove_Albion_logo.svg', 'Amex Stadium, Brighton', '#0057B8', '#FFFFFF'],
            ['Wolverhampton', 1, 'https://upload.wikimedia.org/wikipedia/en/f/fc/Wolverhampton_Wanderers.svg', 'Molineux Stadium, Wolverhampton', '#FDB913', '#231F20'],
            ['Everton', 1, 'https://upload.wikimedia.org/wikipedia/en/7/7c/Everton_FC_logo.svg', 'Goodison Park, Liverpool', '#003399', '#FFFFFF'],
            ['West Ham United', 1, 'https://upload.wikimedia.org/wikipedia/en/c/c2/West_Ham_United_FC_logo.svg', 'London Stadium, London', '#7A263A', '#1BB1E7'],
            ['Leicester City', 1, 'https://upload.wikimedia.org/wikipedia/en/2/2d/Leicester_City_crest.svg', 'King Power Stadium, Leicester', '#003090', '#FDB913'],
            ['Ipswich Tonw', 1, 'logos/England - Premier League/Ipswich Town.png', 'Elland Road, Leeds', '#FFCD00', '#1D428A'],
            ['Southampton', 1, 'https://upload.wikimedia.org/wikipedia/en/c/c9/FC_Southampton.svg', 'St Mary’s Stadium, Southampton', '#D71920', '#FFFFFF'],
            ['Nottingham Forest', 1, 'logos/England - Premier League/Nottingham Forest.png', 'City Ground, Nottingham', '#E53233', '#FFFFFF'],

            ['Real Madrid', 2, 'https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg', 'Santiago Bernabéu, Madrid', '#FEBE10', '#00529F'],
            ['Barcelona', 2, 'https://upload.wikimedia.org/wikipedia/en/4/47/FC_Barcelona_%28crest%29.svg', 'Camp Nou, Barcelona', '#A50044', '#004D98'],
            ['Atletico Madrid', 2, 'logos\Spain - la liga\Atlético de Madrid.png', 'Wanda Metropolitano, Madrid', '#C8102E', '#00008B'],
            ['Sevilla', 2, 'logos\Spain - la liga\Sevilla FC.png', 'Ramón Sánchez-Pizjuán, Seville', '#DA291C', '#FFFFFF'],
            ['Real Sociedad', 2, 'https://upload.wikimedia.org/wikipedia/en/f/f1/Real_Sociedad_logo.svg', 'Reale Arena, San Sebastián', '#0057B8', '#FFFFFF'],
            ['Real Betis', 2, 'logos\Spain - la liga\Real Betis Balompié.png', 'Benito Villamarín, Seville', '#1E8449', '#FFFFFF'],
            ['Villarreal', 2, 'logos\Spain - la liga\Villarreal CF.png', 'Estadio de la Cerámica, Villarreal', '#FFEE00', '#003399'],
            ['Athletic Bilbao', 2, 'https://upload.wikimedia.org/wikipedia/en/9/98/Club_Athletic_Bilbao_logo.svg', 'San Mamés, Bilbao', '#EE1C25', '#000000'],
            ['Valencia', 2, 'https://upload.wikimedia.org/wikipedia/en/c/ce/Valenciacf.svg', 'Mestalla Stadium, Valencia', '#F5A623', '#231F20'],
            ['Celta Vigo', 2, 'logos\Spain - la liga\Celta de Vigo.png', 'Abanca-Balaídos, Vigo', '#A0D0FF', '#DA291C'],
            ['Osasuna', 2, 'logos\Spain - la liga\CA Osasuna.png', 'El Sadar, Pamplona', '#D71920', '#132257'],
            ['Espanyol', 2, 'logos\Spain - la liga\RCD Espanyol Barcelona.png', 'RCDE Stadium, Barcelona', '#00529F', '#FFFFFF'],
            ['Getafe', 2, 'logos\Spain - la liga\Getafe CF.png', 'Coliseum Alfonso Pérez, Getafe', '#0057B8', '#FFFFFF'],
            ['Girona', 2, 'logos\Spain - la liga\Girona FC.png', 'Nuevo Estadio de Los Cármenes, Girona', '#DA291C', '#FFFFFF'],
            ['Alavés', 2, 'logos\Spain - la liga\Deportivo Alavés.png', 'Mendizorrotza, Vitoria-Gasteiz', '#00529F', '#FFFFFF'],
            ['Mallorca', 2, 'logos\Spain - la liga\RCD Mallorca.png', 'Visit Mallorca Stadium', '#DA291C', '#FFD700'],

            ['Juventus', 3, 'logos\Italy - Serie A\Juventus FC.png', 'Allianz Stadium, Turin', '#000000', '#FFFFFF'],
            ['Inter Milan', 3, 'logos\Italy - Serie A\Inter Milan.png', 'San Siro, Milan', '#00529F', '#FFFFFF'],
            ['AC Milan', 3, 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Logo_of_AC_Milan.svg', 'San Siro, Milan', '#FB090B', '#000000'],
            ['AS Roma', 3, 'https://upload.wikimedia.org/wikipedia/en/f/f7/AS_Roma_logo_%282017%29.svg', 'Stadio Olimpico, Rome', '#8E1111', '#FDB913'],
            ['Lazio', 3, 'logos\Italy - Serie A\SS Lazio.png', 'Stadio Olimpico, Rome', '#ADD8E6', '#FFFFFF'],
            ['Napoli', 3, 'logos\Italy - Serie A\SSC Napoli.png', 'Stadio Diego Armando Maradona, Naples', '#007FFF', '#FFFFFF'],
            ['Atalanta', 3, 'logos\Italy - Serie A\Atalanta BC.png', 'Gewiss Stadium, Bergamo', '#1D2649', '#00BFFF'],
            ['Verona', 3, 'logos\Italy - Serie A\Hellas Verona.png', 'Artemio Franchi, Florence', '#582C83', '#FFFFFF'],
            ['Torino', 3, 'logos\Italy - Serie A\Torino FC.png', 'Stadio Olimpico Grande Torino, Turin', '#800000', '#FFFFFF'],
            ['Venezia', 3, 'logos\Italy - Serie A\Venezia FC.png', 'Mapei Stadium, Reggio Emilia', '#008000', '#000000'],
            ['Udinese', 3, 'logos\Italy - Serie A\Udinese Calcio.png', 'Dacia Arena, Udine', '#000000', '#FFFFFF'],
            ['Bologna', 3, 'logos\Italy - Serie A\Bologna FC 1909.png', 'Stadio Renato Dall’Ara, Bologna', '#000066', '#A00000'],
            ['Monza', 3, 'logos\Italy - Serie A\AC Monza.png', 'U-Power Stadium, Monza', '#FF0000', '#FFFFFF'],
            ['Empoli', 3, 'logos\Italy - Serie A\FC Empoli.png', 'Stadio Carlo Castellani, Empoli', '#0033CC', '#FFFFFF'],
            ['Genoa', 3, 'logos\Italy - Serie A\Genoa CFC.png', 'Stadio Luigi Ferraris, Genoa', '#C8102E', '#FFD700'],
            ['Lecce', 3, 'logos\Italy - Serie A\US Lecce.png', 'Stadio Via del Mare, Lecce', '#002E5D', '#FFD700'],

            ['Bayern Munich', 4, 'logos\Germany - Bundesliga\Bayern Munich.png', 'Allianz Arena, Munich', '#DC052D', '#0066B2'],
            ['Borussia Dortmund', 4, 'https://upload.wikimedia.org/wikipedia/commons/6/67/Borussia_Dortmund_logo.svg', 'Signal Iduna Park, Dortmund', '#FDE100', '#000000'],
            ['RB Leipzig', 4, 'https://upload.wikimedia.org/wikipedia/en/0/04/RB_Leipzig_2014_logo.svg', 'Red Bull Arena, Leipzig', '#DA291C', '#FFFFFF'],
            ['Union Berlin', 4, 'logos\Germany - Bundesliga\1.FC Union Berlin.png', 'Stadion An der Alten Försterei, Berlin', '#DA291C', '#FEDD00'],
            ['Bayer Leverkusen', 4, 'https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg', 'BayArena, Leverkusen', '#E32219', '#000000'],
            ['Eintracht Frankfurt', 4, 'logos\Germany - Bundesliga\Eintracht Frankfurt.png', 'Deutsche Bank Park, Frankfurt', '#DA291C', '#000000'],
            ['SC Freiburg', 4, 'logos\Germany - Bundesliga\SC Freiburg.png', 'Europa-Park Stadion, Freiburg', '#000000', '#FFFFFF'],
            ['Mainz 05', 4, 'logos\Germany - Bundesliga\1.FSV Mainz 05.png', 'MEWA Arena, Mainz', '#C8102E', '#FFFFFF'],
            ['Hoffenheim', 4, 'logos\Germany - Bundesliga\TSG 1899 Hoffenheim.png', 'PreZero Arena, Sinsheim', '#1D5BA4', '#FFFFFF'],
            ['Werder Bremen', 4, 'logos\Germany - Bundesliga\SV Werder Bremen.png', 'Weserstadion, Bremen', '#008751', '#FFFFFF'],
            ['Wolfsburg', 4, 'logos\Germany - Bundesliga\VfL Wolfsburg.png', 'Volkswagen Arena, Wolfsburg', '#65B32E', '#FFFFFF'],
            ['Augsburg', 4, 'logos\Germany - Bundesliga\FC Augsburg.png', 'WWK Arena, Augsburg', '#DA291C', '#006F35'],
            ['VfB Stuttgart', 4, 'logos\Germany - Bundesliga\VfB Stuttgart.png', 'Mercedes-Benz Arena, Stuttgart', '#DA291C', '#FFFFFF'],
            ['FC St. Pauli', 4, 'logos\Germany - Bundesliga\FC St. Pauli.png', 'Vonovia Ruhrstadion, Bochum', '#004B87', '#FFFFFF'],
            ['Holstein Kiel', 4, 'logos\Germany - Bundesliga\Holstein Kiel.png', 'RheinEnergieStadion, Cologne', '#E30613', '#FFFFFF'],
            ['Heidenheim', 4, 'logos\Germany - Bundesliga\1.FC Heidenheim 1846.png', 'Voith-Arena, Heidenheim', '#DA291C', '#000066'],

            ['Paris Saint-Germain', 5, 'https://upload.wikimedia.org/wikipedia/en/a/a7/Paris_Saint-Germain_F.C..svg', 'Parc des Princes, Paris', '#004170', '#DA291C'],
            ['Marseille', 5, 'logos\France - Ligue 1\Olympique Marseille.png', 'Stade Vélodrome, Marseille', '#00AEEF', '#FFFFFF'],
            ['Lyon', 5, 'logos\France - Ligue 1\Olympique Lyon.png', 'Groupama Stadium, Lyon', '#DA291C', '#003399'],
            ['Monaco', 5, 'logos\France - Ligue 1\AS Monaco.png', 'Stade Louis II, Monaco', '#DA291C', '#FFD700'],
            ['Lille', 5, 'logos\France - Ligue 1\LOSC Lille.png', 'Stade Pierre-Mauroy, Lille', '#E32636', '#002856'],
            ['Nice', 5, 'logos\France - Ligue 1\OGC Nice.png', 'Allianz Riviera, Nice', '#000000', '#DA291C'],
            ['Rennes', 5, 'logos\France - Ligue 1\Stade Rennais FC.png', 'Roazhon Park, Rennes', '#DA291C', '#000000'],
            ['Lens', 5, 'logos\France - Ligue 1\RC Lens.png', 'Stade Bollaert-Delelis, Lens', '#FFD700', '#DA291C'],
            ['Strasbourg', 5, 'logos\France - Ligue 1\RC Strasbourg Alsace.png', 'Stade de la Meinau, Strasbourg', '#0072BB', '#FFFFFF'],
            ['Montpellier', 5, 'logos\France - Ligue 1\Montpellier HSC.png', 'Stade de la Mosson, Montpellier', '#FF7F00', '#00008B'],
            ['Toulouse', 5, 'logos\France - Ligue 1\FC Toulouse.png', 'Stadium de Toulouse', '#5F259F', '#FFFFFF'],
            ['Reims', 5, 'logos\France - Ligue 1\Stade Reims.png', 'Stade Auguste-Delaune, Reims', '#DA291C', '#FFFFFF'],
            ['Brest', 5, 'logos\France - Ligue 1\Stade Brestois 29.png', 'Stade Francis-Le Blé, Brest', '#E32636', '#FFFFFF'],
            ['AJ Auxerre', 5, 'logos\France - Ligue 1\AJ Auxerre.png', 'Stade Gabriel Montpied, Clermont', '#0055A4', '#DA291C'],
            ['FC Nantes', 5, 'logos\France - Ligue 1\FC Nantes.png', 'Stade de la Beaujoire, Nantes', '#FFD700', '#008000'],
            ['Angers SCO', 5, 'logos\France - Ligue 1\Angers SCO.png', 'Stade du Moustoir, Lorient', '#FF6600', '#000000']
        ];

            foreach ($teams as [$name, $divisionId, $logo, $address, $primaryColor, $secondaryColor]) {
            Team::create([
                'name' => $name,
                'division_id' => $divisionId,
                'logo' => $logo,
                'address' => $address,
                'primary_color' => $primaryColor,
                'secondary_color' => $secondaryColor,
                'matches_played' => rand(30, 38),
                'goals_for' => rand(30, 90),
                'goals_against' => rand(20, 70),
                'wins' => rand(10, 25),
                'losses' => rand(3, 15),
                'draws' => rand(0, 15),
            ]);
        }
    }
}
