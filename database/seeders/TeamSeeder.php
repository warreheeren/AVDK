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
            ['Manchester United', 1, 'https://upload.wikimedia.org/wikipedia/commons/7/7a/Manchester_United_FC_crest_2016.svg', 'Old Trafford, Manchester', '#DA291C', '#FBE122'],
            ['Arsenal', 1, 'https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg', 'Emirates Stadium, London', '#EF0107', '#023474'],
            ['Manchester City', 1, 'https://upload.wikimedia.org/wikipedia/en/e/eb/Manchester_City_FC_badge.svg', 'Etihad Stadium, Manchester', '#6CABDD', '#1C2C5B'],
            ['Liverpool', 1, 'https://upload.wikimedia.org/wikipedia/en/0/0c/Liverpool_FC.svg', 'Anfield, Liverpool', '#C8102E', '#00B2A9'],
            ['Chelsea', 1, 'https://upload.wikimedia.org/wikipedia/en/c/cc/Chelsea_FC.svg', 'Stamford Bridge, London', '#034694', '#FFFFFF'],
            ['Tottenham Hotspur', 1, 'https://upload.wikimedia.org/wikipedia/en/b/b4/Tottenham_Hotspur.svg', 'Tottenham Hotspur Stadium', '#132257', '#FFFFFF'],
            ['Newcastle United', 1, 'https://upload.wikimedia.org/wikipedia/en/5/56/Newcastle_United_Logo.svg', 'St. James’ Park, Newcastle', '#241F20', '#FFFFFF'],
            ['Aston Villa', 1, 'https://upload.wikimedia.org/wikipedia/en/f/f9/Aston_Villa_logo.svg', 'Villa Park, Birmingham', '#670E36', '#95BFE5'],
            ['Brighton', 1, 'https://upload.wikimedia.org/wikipedia/en/f/fd/Brighton_%26_Hove_Albion_logo.svg', 'Amex Stadium, Brighton', '#0057B8', '#FFFFFF'],
            ['Wolverhampton', 1, 'https://upload.wikimedia.org/wikipedia/en/f/fc/Wolverhampton_Wanderers.svg', 'Molineux Stadium, Wolverhampton', '#FDB913', '#231F20'],
            ['Everton', 1, 'https://upload.wikimedia.org/wikipedia/en/7/7c/Everton_FC_logo.svg', 'Goodison Park, Liverpool', '#003399', '#FFFFFF'],
            ['West Ham United', 1, 'https://upload.wikimedia.org/wikipedia/en/c/c2/West_Ham_United_FC_logo.svg', 'London Stadium, London', '#7A263A', '#1BB1E7'],
            ['Leicester City', 1, 'https://upload.wikimedia.org/wikipedia/en/2/2d/Leicester_City_crest.svg', 'King Power Stadium, Leicester', '#003090', '#FDB913'],
            ['Leeds United', 1, 'https://upload.wikimedia.org/wikipedia/en/0/0c/Leeds_United_Logo.svg', 'Elland Road, Leeds', '#FFCD00', '#1D428A'],
            ['Southampton', 1, 'https://upload.wikimedia.org/wikipedia/en/c/c9/FC_Southampton.svg', 'St Mary’s Stadium, Southampton', '#D71920', '#FFFFFF'],
            ['Nottingham Forest', 1, 'https://upload.wikimedia.org/wikipedia/en/e/e5/Nottingham_Forest_FC_logo.svg', 'City Ground, Nottingham', '#E53233', '#FFFFFF'],

            // --- La Liga (division_id = 2) ---
            ['Real Madrid', 2, 'https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg', 'Santiago Bernabéu, Madrid', '#FEBE10', '#00529F'],
            ['Barcelona', 2, 'https://upload.wikimedia.org/wikipedia/en/4/47/FC_Barcelona_%28crest%29.svg', 'Camp Nou, Barcelona', '#A50044', '#004D98'],
            ['Atletico Madrid', 2, 'https://upload.wikimedia.org/wikipedia/en/f/f4/Atletico_Madrid_2017_logo.svg', 'Wanda Metropolitano, Madrid', '#C8102E', '#00008B'],
            ['Sevilla', 2, 'https://upload.wikimedia.org/wikipedia/en/5/5e/Sevilla_FC_logo.svg', 'Ramón Sánchez-Pizjuán, Seville', '#DA291C', '#FFFFFF'],
            ['Real Sociedad', 2, 'https://upload.wikimedia.org/wikipedia/en/f/f1/Real_Sociedad_logo.svg', 'Reale Arena, San Sebastián', '#0057B8', '#FFFFFF'],
            ['Real Betis', 2, 'https://upload.wikimedia.org/wikipedia/en/5/56/Real_Betis_logo.svg', 'Benito Villamarín, Seville', '#1E8449', '#FFFFFF'],
            ['Villarreal', 2, 'https://upload.wikimedia.org/wikipedia/en/7/70/Villarreal_CF_logo.svg', 'Estadio de la Cerámica, Villarreal', '#FFEE00', '#003399'],
            ['Athletic Bilbao', 2, 'https://upload.wikimedia.org/wikipedia/en/9/98/Club_Athletic_Bilbao_logo.svg', 'San Mamés, Bilbao', '#EE1C25', '#000000'],
            ['Valencia', 2, 'https://upload.wikimedia.org/wikipedia/en/c/ce/Valenciacf.svg', 'Mestalla Stadium, Valencia', '#F5A623', '#231F20'],
            ['Celta Vigo', 2, 'https://upload.wikimedia.org/wikipedia/en/1/14/RC_Celta_de_Vigo_logo.svg', 'Abanca-Balaídos, Vigo', '#A0D0FF', '#DA291C'],
            ['Osasuna', 2, 'https://upload.wikimedia.org/wikipedia/en/3/3c/CA_Osasuna_logo.svg', 'El Sadar, Pamplona', '#D71920', '#132257'],
            ['Espanyol', 2, 'https://upload.wikimedia.org/wikipedia/en/2/2d/RCD_Espanyol_logo.svg', 'RCDE Stadium, Barcelona', '#00529F', '#FFFFFF'],
            ['Getafe', 2, 'https://upload.wikimedia.org/wikipedia/en/9/9e/Getafe_CF_logo.svg', 'Coliseum Alfonso Pérez, Getafe', '#0057B8', '#FFFFFF'],
            ['Granada', 2, 'https://upload.wikimedia.org/wikipedia/en/6/65/Granada_CF_logo.svg', 'Nuevo Estadio de Los Cármenes, Granada', '#DA291C', '#FFFFFF'],
            ['Alavés', 2, 'https://upload.wikimedia.org/wikipedia/en/2/2e/Deportivo_Alav%C3%A9s_logo.svg', 'Mendizorrotza, Vitoria-Gasteiz', '#00529F', '#FFFFFF'],
            ['Mallorca', 2, 'https://upload.wikimedia.org/wikipedia/en/d/d3/RCD_Mallorca_logo.svg', 'Visit Mallorca Stadium', '#DA291C', '#FFD700'],
            ['Juventus', 3, 'https://upload.wikimedia.org/wikipedia/commons/1/15/Juventus_FC_2017_logo.svg', 'Allianz Stadium, Turin', '#000000', '#FFFFFF'],
            ['Inter Milan', 3, 'https://upload.wikimedia.org/wikipedia/en/0/0b/Inter_Milan.svg', 'San Siro, Milan', '#00529F', '#FFFFFF'],
            ['AC Milan', 3, 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Logo_of_AC_Milan.svg', 'San Siro, Milan', '#FB090B', '#000000'],
            ['AS Roma', 3, 'https://upload.wikimedia.org/wikipedia/en/f/f7/AS_Roma_logo_%282017%29.svg', 'Stadio Olimpico, Rome', '#8E1111', '#FDB913'],
            ['Lazio', 3, 'https://upload.wikimedia.org/wikipedia/en/e/e4/SS_Lazio_badge.svg', 'Stadio Olimpico, Rome', '#ADD8E6', '#FFFFFF'],
            ['Napoli', 3, 'https://upload.wikimedia.org/wikipedia/commons/2/2d/SSC_Napoli.svg', 'Stadio Diego Armando Maradona, Naples', '#007FFF', '#FFFFFF'],
            ['Atalanta', 3, 'https://upload.wikimedia.org/wikipedia/en/5/5b/AtalantaBC.svg', 'Gewiss Stadium, Bergamo', '#1D2649', '#00BFFF'],
            ['Fiorentina', 3, 'https://upload.wikimedia.org/wikipedia/en/e/e8/ACF_Fiorentina_2.svg', 'Artemio Franchi, Florence', '#582C83', '#FFFFFF'],
            ['Torino', 3, 'https://upload.wikimedia.org/wikipedia/en/5/53/Torino_FC_Logo.svg', 'Stadio Olimpico Grande Torino, Turin', '#800000', '#FFFFFF'],
            ['Sassuolo', 3, 'https://upload.wikimedia.org/wikipedia/en/f/f2/US_Sassuolo_Calcio_logo.svg', 'Mapei Stadium, Reggio Emilia', '#008000', '#000000'],
            ['Udinese', 3, 'https://upload.wikimedia.org/wikipedia/en/8/8f/Udinese_Calcio_logo.svg', 'Dacia Arena, Udine', '#000000', '#FFFFFF'],
            ['Bologna', 3, 'https://upload.wikimedia.org/wikipedia/en/7/7c/Bologna_FC_1909_logo.svg', 'Stadio Renato Dall’Ara, Bologna', '#000066', '#A00000'],
            ['Monza', 3, 'https://upload.wikimedia.org/wikipedia/en/2/2a/AC_Monza_2021_logo.svg', 'U-Power Stadium, Monza', '#FF0000', '#FFFFFF'],
            ['Empoli', 3, 'https://upload.wikimedia.org/wikipedia/en/6/65/Empoli_F.C._logo.svg', 'Stadio Carlo Castellani, Empoli', '#0033CC', '#FFFFFF'],
            ['Genoa', 3, 'https://upload.wikimedia.org/wikipedia/en/5/59/Genoa_CFC_logo.svg', 'Stadio Luigi Ferraris, Genoa', '#C8102E', '#FFD700'],
            ['Lecce', 3, 'https://upload.wikimedia.org/wikipedia/en/d/dc/US_Lecce_2018_logo.svg', 'Stadio Via del Mare, Lecce', '#002E5D', '#FFD700'],

            // --- Bundesliga (division_id = 4) ---
            ['Bayern Munich', 4, 'https://upload.wikimedia.org/wikipedia/en/1/1f/FC_Bayern_München_logo_%282017%29.svg', 'Allianz Arena, Munich', '#DC052D', '#0066B2'],
            ['Borussia Dortmund', 4, 'https://upload.wikimedia.org/wikipedia/commons/6/67/Borussia_Dortmund_logo.svg', 'Signal Iduna Park, Dortmund', '#FDE100', '#000000'],
            ['RB Leipzig', 4, 'https://upload.wikimedia.org/wikipedia/en/0/04/RB_Leipzig_2014_logo.svg', 'Red Bull Arena, Leipzig', '#DA291C', '#FFFFFF'],
            ['Union Berlin', 4, 'https://upload.wikimedia.org/wikipedia/en/d/d2/1.FC_Union_Berlin_logo.svg', 'Stadion An der Alten Försterei, Berlin', '#DA291C', '#FEDD00'],
            ['Bayer Leverkusen', 4, 'https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg', 'BayArena, Leverkusen', '#E32219', '#000000'],
            ['Eintracht Frankfurt', 4, 'https://upload.wikimedia.org/wikipedia/en/0/04/Eintracht_Frankfurt_Logo.svg', 'Deutsche Bank Park, Frankfurt', '#DA291C', '#000000'],
            ['SC Freiburg', 4, 'https://upload.wikimedia.org/wikipedia/en/8/86/SC_Freiburg_logo.svg', 'Europa-Park Stadion, Freiburg', '#000000', '#FFFFFF'],
            ['Mainz 05', 4, 'https://upload.wikimedia.org/wikipedia/en/6/64/FSV_Mainz_05_Logo.svg', 'MEWA Arena, Mainz', '#C8102E', '#FFFFFF'],
            ['Hoffenheim', 4, 'https://upload.wikimedia.org/wikipedia/en/b/b0/TSG_1899_Hoffenheim_logo.svg', 'PreZero Arena, Sinsheim', '#1D5BA4', '#FFFFFF'],
            ['Werder Bremen', 4, 'https://upload.wikimedia.org/wikipedia/en/b/be/SV-Werder-Bremen-Logo.svg', 'Weserstadion, Bremen', '#008751', '#FFFFFF'],
            ['Wolfsburg', 4, 'https://upload.wikimedia.org/wikipedia/en/f/f3/VfL_Wolfsburg_Logo.svg', 'Volkswagen Arena, Wolfsburg', '#65B32E', '#FFFFFF'],
            ['Augsburg', 4, 'https://upload.wikimedia.org/wikipedia/en/6/63/FC_Augsburg_logo.svg', 'WWK Arena, Augsburg', '#DA291C', '#006F35'],
            ['VfB Stuttgart', 4, 'https://upload.wikimedia.org/wikipedia/en/d/df/VfB_Stuttgart_1893_Logo.svg', 'Mercedes-Benz Arena, Stuttgart', '#DA291C', '#FFFFFF'],
            ['Bochum', 4, 'https://upload.wikimedia.org/wikipedia/en/8/81/VfL_Bochum_logo.svg', 'Vonovia Ruhrstadion, Bochum', '#004B87', '#FFFFFF'],
            ['Köln', 4, 'https://upload.wikimedia.org/wikipedia/en/0/01/FC_Cologne_logo.svg', 'RheinEnergieStadion, Cologne', '#E30613', '#FFFFFF'],
            ['Heidenheim', 4, 'https://upload.wikimedia.org/wikipedia/en/f/f1/1._FC_Heidenheim_logo.svg', 'Voith-Arena, Heidenheim', '#DA291C', '#000066'],

            // --- Ligue 1 (division_id = 5) ---
            ['Paris Saint-Germain', 5, 'https://upload.wikimedia.org/wikipedia/en/a/a7/Paris_Saint-Germain_F.C..svg', 'Parc des Princes, Paris', '#004170', '#DA291C'],
            ['Marseille', 5, 'https://upload.wikimedia.org/wikipedia/en/6/63/Olympique_Marseille_logo.svg', 'Stade Vélodrome, Marseille', '#00AEEF', '#FFFFFF'],
            ['Lyon', 5, 'https://upload.wikimedia.org/wikipedia/en/c/c6/Olympique_Lyonnais.svg', 'Groupama Stadium, Lyon', '#DA291C', '#003399'],
            ['Monaco', 5, 'https://upload.wikimedia.org/wikipedia/en/d/d7/AS_Monaco_FC_logo.svg', 'Stade Louis II, Monaco', '#DA291C', '#FFD700'],
            ['Lille', 5, 'https://upload.wikimedia.org/wikipedia/en/b/b7/Lille_OSC_crest.svg', 'Stade Pierre-Mauroy, Lille', '#E32636', '#002856'],
            ['Nice', 5, 'https://upload.wikimedia.org/wikipedia/en/e/ef/OGC_Nice_logo.svg', 'Allianz Riviera, Nice', '#000000', '#DA291C'],
            ['Rennes', 5, 'https://upload.wikimedia.org/wikipedia/en/2/2e/Stade_Rennais_FC.svg', 'Roazhon Park, Rennes', '#DA291C', '#000000'],
            ['Lens', 5, 'https://upload.wikimedia.org/wikipedia/en/f/fb/RC_Lens_logo.svg', 'Stade Bollaert-Delelis, Lens', '#FFD700', '#DA291C'],
            ['Strasbourg', 5, 'https://upload.wikimedia.org/wikipedia/en/5/59/Racing_Club_de_Strasbourg_logo.svg', 'Stade de la Meinau, Strasbourg', '#0072BB', '#FFFFFF'],
            ['Montpellier', 5, 'https://upload.wikimedia.org/wikipedia/en/e/ef/Montpellier_HSC_logo.svg', 'Stade de la Mosson, Montpellier', '#FF7F00', '#00008B'],
            ['Toulouse', 5, 'https://upload.wikimedia.org/wikipedia/en/1/1e/Toulouse_FC_2020_Logo.svg', 'Stadium de Toulouse', '#5F259F', '#FFFFFF'],
            ['Reims', 5, 'https://upload.wikimedia.org/wikipedia/en/e/e6/Stade_Reims_logo.svg', 'Stade Auguste-Delaune, Reims', '#DA291C', '#FFFFFF'],
            ['Brest', 5, 'https://upload.wikimedia.org/wikipedia/en/4/4e/Stade_Brestois_29_logo.svg', 'Stade Francis-Le Blé, Brest', '#E32636', '#FFFFFF'],
            ['Clermont', 5, 'https://upload.wikimedia.org/wikipedia/en/b/bb/Clermont_Foot_63_logo.svg', 'Stade Gabriel Montpied, Clermont', '#0055A4', '#DA291C'],
            ['Nantes', 5, 'https://upload.wikimedia.org/wikipedia/en/1/11/FC_Nantes_logo.svg', 'Stade de la Beaujoire, Nantes', '#FFD700', '#008000'],
            ['Lorient', 5, 'https://upload.wikimedia.org/wikipedia/en/5/5d/FC_Lorient_logo.svg', 'Stade du Moustoir, Lorient', '#FF6600', '#000000']
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