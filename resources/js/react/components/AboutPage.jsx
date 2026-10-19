import { Target, Eye, Users, Heart, Globe, Lightbulb, Award, TrendingUp } from "lucide-react";
import styles from "./AboutPage.module.css";

export default function AboutPage() {
  // Récupération des données injectées par Laravel
  const about = window.LaravelData?.about || {};

  // Sections principales
  const hero = about.hero || {};
  const vision = about.vision || {};
  const mission = about.mission || {};
  const valeurs = about.valeurs || [];
  const equipe = about.equipe || [];
  const partenaires = about.partenaires || [];
  const stats = about.stats || [];

  // Mapping des icônes dynamiques
  const getIcon = (iconName, className) => {
    const icons = {
      Heart: <Heart className={className} />,
      Users: <Users className={className} />,
      Target: <Target className={className} />,
      Globe: <Globe className={className} />,
      Lightbulb: <Lightbulb className={className} />,
      Eye: <Eye className={className} />,
      Award: <Award className={className} />,
      TrendingUp: <TrendingUp className={className} />
    };
    return icons[iconName] || <Heart className={className} />;
  };

  return (
    <div className={styles.page}>
      <main className={styles.main}>
        {/* Hero Section - Dynamique */}
        <section className={styles.hero}>
          <div className={styles.container}>
            <div className={styles.heroContent}>
              <h1 className={styles.heroTitle}>
                {hero.title || "À propos de YOULIDA"}
              </h1>
              <p className={styles.heroSubtitle}>
                {hero.subtitle || "Young Leader's Initiatives for Development of Africa"}
              </p>
              {hero.description && (
                <p className={styles.heroDescription}>{hero.description}</p>
              )}
            </div>
          </div>
        </section>

        {/* Stats Section - Optionnelle */}
        {stats.length > 0 && (
          <section className={styles.stats}>
            <div className={styles.container}>
              <div className={styles.statsGrid}>
                {stats.map(stat => (
                  <div key={stat.id} className={styles.statItem}>
                    <div className={styles.statNumber}>{stat.value}</div>
                    <div className={styles.statLabel}>{stat.label}</div>
                  </div>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* Vision & Mission Section - Dynamique */}
        <section className={styles.visionMission}>
          <div className={styles.container}>
            <div className={styles.visionMissionGrid}>
              {/* Vision Card */}
              <div className={`${styles.card} ${styles.visionCard}`}>
                <div className={styles.cardContent}>
                  <div className={styles.cardIcon}>
                    {getIcon(vision.icon || 'Eye', styles.icon)}
                  </div>
                  <h2 className={styles.cardTitle}>
                    {vision.title || "Notre Vision"}
                  </h2>
                  {vision.content ? (
                    <p className={styles.cardText}>{vision.content}</p>
                  ) : (
                    <>
                      <p className={styles.cardText}>
                        Engager les jeunes africains à être des acteurs de changement pour eux-mêmes et pour leurs communautés.
                      </p>
                      <p className={styles.cardText}>
                        Nous croyons en un avenir où chaque jeune africain a les connaissances, les compétences et la
                        confiance nécessaires pour réaliser son plein potentiel.
                      </p>
                    </>
                  )}
                </div>
              </div>

              {/* Mission Card */}
              <div className={`${styles.card} ${styles.missionCard}`}>
                <div className={styles.cardContent}>
                  <div className={styles.cardIcon}>
                    {getIcon(mission.icon || 'Target', styles.icon)}
                  </div>
                  <h2 className={styles.cardTitle}>
                    {mission.title || "Notre Mission"}
                  </h2>
                  {mission.content ? (
                    <p className={styles.cardText}>{mission.content}</p>
                  ) : (
                    <>
                      <p className={styles.cardText}>
                        Permettre aux adolescents et jeunes africains de prendre des décisions éclairées sur leur vie
                        éducative, sexuelle, leur bien-être et leur santé.
                      </p>
                      <p className={styles.cardText}>
                        À travers des programmes innovants et une approche communautaire, nous offrons aux jeunes les outils
                        et le soutien dont ils ont besoin.
                      </p>
                    </>
                  )}
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Values Section - Dynamique */}
        <section className={styles.values}>
          <div className={styles.container}>
            <div className={styles.sectionHeader}>
              <h2 className={styles.sectionTitle}>Nos Valeurs</h2>
              <p className={styles.sectionDescription}>
                Les principes qui guident notre action au quotidien
              </p>
            </div>

            <div className={styles.valuesGrid}>
              {valeurs.length > 0 ? (
                valeurs.map(valeur => (
                  <div key={valeur.id} className={styles.valueCard}>
                    <div className={styles.valueIcon}>
                      {getIcon(valeur.icon, styles.valueSvg)}
                    </div>
                    <h3 className={styles.valueTitle}>{valeur.title}</h3>
                    <p className={styles.valueDescription}>{valeur.description}</p>
                  </div>
                ))
              ) : (
                // Valeurs par défaut
                <>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Heart className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Empathie</h3>
                    <p className={styles.valueDescription}>Nous écoutons et comprenons les besoins uniques de chaque jeune.</p>
                  </div>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Users className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Inclusion</h3>
                    <p className={styles.valueDescription}>Nous créons des espaces sûrs où tous les adolescent(e)s et jeunes sont écoutés et accompagnés sans distinction.</p>
                  </div>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Lightbulb className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Innovation</h3>
                    <p className={styles.valueDescription}>Nous développons des solutions créatives adaptées aux réalités des jeunes africains.</p>
                  </div>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Target className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Excellence</h3>
                    <p className={styles.valueDescription}>Nous visons la qualité dans tous nos programmes.</p>
                  </div>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Globe className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Collaboration</h3>
                    <p className={styles.valueDescription}>Nous travaillons en partenariat avec les communautés.</p>
                  </div>
                  <div className={styles.valueCard}>
                    <div className={styles.valueIcon}><Heart className={styles.valueSvg} /></div>
                    <h3 className={styles.valueTitle}>Intégrité</h3>
                    <p className={styles.valueDescription}>Nous agissons avec transparence et responsabilité.</p>
                  </div>
                </>
              )}
            </div>
          </div>
        </section>

        {/* Team Section - Dynamique */}
        <section className={styles.team}>
          <div className={styles.container}>
            <div className={styles.sectionHeader}>
              <h2 className={styles.sectionTitle}>Notre Équipe</h2>
              <p className={styles.sectionDescription}>
                Des professionnels passionnés dédiés à l'autonomisation de la jeunesse africaine
              </p>
            </div>

            <div className={styles.teamGrid}>
              {equipe.length > 0 ? (
                equipe.slice(0, 4).map(membre => (
                  <div key={membre.id} className={styles.teamCard}>
                    {membre.photo ? (
                      <img
                        src={membre.photo}
                        alt={membre.name}
                        className={styles.teamAvatar}
                        onError={(e) => {
                          e.target.style.display = 'none';
                          e.target.parentElement.innerHTML = `<div class="${styles.teamAvatarPlaceholder}">${membre.name?.charAt(0) || 'M'}</div>`;
                        }}
                      />
                    ) : (
                      <div className={styles.teamAvatarPlaceholder}>
                        {membre.name?.charAt(0) || 'M'}
                      </div>
                    )}
                    <h3 className={styles.teamName}>{membre.name}</h3>
                    <p className={styles.teamRole}>{membre.role || 'Membre'}</p>
                    {membre.bio && <p className={styles.teamBio}>{membre.bio}</p>}
                  </div>
                ))
              ) : (
                // Équipe par défaut
                <>
                  <div className={styles.teamCard}>
                    <div className={styles.teamAvatarPlaceholder}>A</div>
                    <h3 className={styles.teamName}>Dr. Aminata Diallo</h3>
                    <p className={styles.teamRole}>Directrice Exécutive</p>
                    <p className={styles.teamBio}>Experte en santé publique avec 15 ans d'expérience en Afrique de l'Ouest.</p>
                  </div>
                  <div className={styles.teamCard}>
                    <div className={styles.teamAvatarPlaceholder}>K</div>
                    <h3 className={styles.teamName}>Kwame Mensah</h3>
                    <p className={styles.teamRole}>Directeur des Programmes</p>
                    <p className={styles.teamBio}>Spécialiste en développement communautaire et éducation des jeunes.</p>
                  </div>
                  <div className={styles.teamCard}>
                    <div className={styles.teamAvatarPlaceholder}>F</div>
                    <h3 className={styles.teamName}>Fatou Ndiaye</h3>
                    <p className={styles.teamRole}>Coordinatrice Éducation</p>
                    <p className={styles.teamBio}>Enseignante passionnée avec une expertise en pédagogie innovante.</p>
                  </div>
                  <div className={styles.teamCard}>
                    <div className={styles.teamAvatarPlaceholder}>I</div>
                    <h3 className={styles.teamName}>Ibrahim Koné</h3>
                    <p className={styles.teamRole}>Responsable Partenariats</p>
                    <p className={styles.teamBio}>Expert en mobilisation de ressources et relations institutionnelles.</p>
                  </div>
                </>
              )}
            </div>

            {equipe.length > 4 && (
              <div className={styles.sectionFooter}>
                <a href="/equipe" className={styles.viewAllLink}>
                  Voir toute l'équipe
                </a>
              </div>
            )}
          </div>
        </section>

{/* Partners Section - Dynamique */}
<section className={styles.partners}>
  <div className={styles.container}>
    <div className={styles.sectionHeader}>
      <h2 className={styles.sectionTitle}>Nos Partenaires</h2>
      <p className={styles.sectionDescription}>Ensemble, nous créons un impact durable</p>
    </div>

    {partenaires.length > 0 ? (
      <div className={styles.partnersGrid}>
        {partenaires.map(partenaire => (
          <div key={partenaire.id} className={styles.partnerCard}>
            {/* Logo */}
            {partenaire.logo ? (
              <img
                src={partenaire.logo}
                alt={partenaire.name}
                className={styles.partnerLogo}
                onError={(e) => {
                  e.target.style.display = 'none';
                }}
              />
            ) : (
              <div className={styles.partnerLogoPlaceholder}>
                {partenaire.name.charAt(0)}
              </div>
            )}

            {/* Nom du partenaire */}
            <h3 className={styles.partnerName}>{partenaire.name}</h3>

            {/* Site web (optionnel) */}
            {partenaire.website && (
              <a
                href={partenaire.website}
                target="_blank"
                rel="noopener noreferrer"
                className={styles.partnerWebsite}
              >
                {partenaire.website.replace(/^https?:\/\//, '')}
              </a>
            )}
          </div>
        ))}
      </div>
    ) : (
      <div className={styles.partnersGrid}>
        {[1, 2, 3, 4, 5, 6, 7, 8].map((i) => (
          <div key={i} className={styles.partnerCard}>
            <div className={styles.partnerLogoPlaceholder}>P</div>
            <h3 className={styles.partnerName}>Partenaire {i}</h3>
          </div>
        ))}
      </div>
    )}

    <div className={styles.partnerCta}>
      <p className={styles.partnerText}>Vous souhaitez devenir partenaire?</p>
      <a href="/contact" className={styles.partnerLink}>
        Contactez-nous
      </a>
    </div>
  </div>
</section>
      </main>
    </div>
  );
}
