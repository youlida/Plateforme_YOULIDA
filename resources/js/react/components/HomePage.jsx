import { Link } from "react-router-dom";
import { Button } from "./ui/button";
import { Card, CardContent } from "./ui/Card";
import { 
  ArrowRight, Heart, Users, BookOpen, Sparkles, Target, Globe, 
  Calendar, MapPin, Eye, Lightbulb, Award, TrendingUp 
} from "lucide-react";
import styles from "./HomePage.module.css";

export default function HomePage() {
  // Récupération des données injectées par Laravel
  const articles = window.LaravelData?.articles || [];
  const programmes = window.LaravelData?.programmes || [];
  const temoignages = window.LaravelData?.temoignages || [];
  const partenaires = window.LaravelData?.partenaires || [];
  const equipe = window.LaravelData?.equipe || [];
  
  // Nouvelles données de la table about
  const about = window.LaravelData?.about || {};
  const hero = about.hero || {};
  const vision = about.vision || {};
  const mission = about.mission || {};
  const values = about.values || [];
  const stats = about.stats || [];

  // Mapping des icônes dynamiques
  const getIcon = (iconName, className) => {
    const icons = {
      Heart: <Heart className={className} />,
      Users: <Users className={className} />,
      BookOpen: <BookOpen className={className} />,
      Sparkles: <Sparkles className={className} />,
      Target: <Target className={className} />,
      Globe: <Globe className={className} />,
      Eye: <Eye className={className} />,
      Lightbulb: <Lightbulb className={className} />,
      Award: <Award className={className} />,
      TrendingUp: <TrendingUp className={className} />,
      Calendar: <Calendar className={className} />,
      MapPin: <MapPin className={className} />
    };
    return icons[iconName] || <Heart className={className} />;
  };

  return (
    <div className={styles.page}>
      <main className={styles.main}>
        {/* Hero Section - Dynamique */}
        <section className={styles.hero}>
          <div className={styles.container}>
            <div className={styles.heroGrid}>
              <div className={styles.heroContent}>
                <div className={styles.badge}>
                  <span>{hero.badge || "Ensemble pour la jeunesse africaine"}</span>
                </div>
                <h1 className={styles.heroTitle}>
                  {hero.title || "Autonomiser les jeunes leaders de demain"}
                </h1>
                <p className={styles.heroDescription}>
                  {hero.description || 
                    "YOULIDA aide les adolescents et jeunes africains à prendre des décisions éclairées sur leur vie éducative, sexuelle, leur bien-être et leur santé."}
                </p>
                <div className={styles.heroButtons}>
                  <Button size="lg" asChild className={styles.primaryButton}>
                    <Link to={hero.primaryButtonLink || "/s-impliquer"}>
                      {hero.primaryButtonText || "Rejoignez-nous"}
                      <ArrowRight className={styles.buttonIcon} />
                    </Link>
                  </Button>
                  <Button size="lg" variant="outline" asChild className={styles.secondaryButton}>
                    <Link to={hero.secondaryButtonLink || "/nos-actions"}>
                      {hero.secondaryButtonText || "Découvrir nos actions"}
                    </Link>
                  </Button>
                </div>
              </div>

              <div className={styles.heroImage}>
                <img
                  src={hero.image || "/images/hero-african-youth.jpg"}
                  alt={hero.imageAlt || "Jeunes africains engagés"}
                  onError={(e) => {
                    e.target.src = "https://via.placeholder.com/600x400?text=Jeunes+Africains";
                  }}
                />
              </div>
            </div>
          </div>
        </section>

        {/* Mission Section - Dynamique avec les valeurs */}
        <section className={styles.mission}>
          <div className={styles.container}>
            <div className={styles.sectionHeader}>
              <h2 className={styles.sectionTitle}>
                {mission.title || "Notre mission"}
              </h2>
              <p className={styles.sectionDescription}>
                {mission.description || 
                  "Promouvoir la mission et les actions de YOULIDA pour créer un impact durable dans les communautés africaines."}
              </p>
            </div>

            <div className={styles.cardsGrid}>
              {values.length > 0 ? (
                values.slice(0, 3).map(value => (
                  <Card key={value.id} className={styles.missionCard}>
                    <CardContent className={styles.cardContent}>
                      <div className={styles.cardIcon}>
                        {getIcon(value.icon, styles.icon)}
                      </div>
                      <h3 className={styles.cardTitle}>{value.title}</h3>
                      <p className={styles.cardDescription}>{value.description}</p>
                    </CardContent>
                  </Card>
                ))
              ) : (
                // Valeurs par défaut
                <>
                  <Card className={styles.missionCard}>
                    <CardContent className={styles.cardContent}>
                      <div className={styles.cardIcon}>
                        <BookOpen className={styles.icon} />
                      </div>
                      <h3 className={styles.cardTitle}>Éducation</h3>
                      <p className={styles.cardDescription}>
                        Permettre aux jeunes de prendre des décisions éclairées sur leur parcours éducatif.
                      </p>
                    </CardContent>
                  </Card>

                  <Card className={styles.missionCard}>
                    <CardContent className={styles.cardContent}>
                      <div className={styles.cardIcon}>
                        <Heart className={styles.icon} />
                      </div>
                      <h3 className={styles.cardTitle}>Santé et bien-être</h3>
                      <p className={styles.cardDescription}>
                        Sensibiliser sur la santé sexuelle, le bien-être mental et physique.
                      </p>
                    </CardContent>
                  </Card>

                  <Card className={styles.missionCard}>
                    <CardContent className={styles.cardContent}>
                      <div className={styles.cardIcon}>
                        <Sparkles className={styles.icon} />
                      </div>
                      <h3 className={styles.cardTitle}>Leadership</h3>
                      <p className={styles.cardDescription}>
                        Engager les jeunes à devenir des acteurs de changement.
                      </p>
                    </CardContent>
                  </Card>
                </>
              )}
            </div>
          </div>
        </section>

        {/* Stats Section - Dynamique depuis la table about_stats */}
        <section className={styles.stats}>
          <div className={styles.container}>
            <div className={styles.statsGrid}>
              {stats.length > 0 ? (
                stats.slice(0, 3).map(stat => (
                  <div key={stat.id} className={styles.statItem}>
                    <div className={styles.statNumber}>{stat.value}</div>
                    <div className={styles.statLabel}>{stat.label}</div>
                  </div>
                ))
              ) : (
                // Statistiques par défaut
                <>
                  <div className={styles.statItem}>
                    <div className={styles.statNumber}>5000+</div>
                    <div className={styles.statLabel}>Jeunes accompagnés</div>
                  </div>
                  <div className={styles.statItem}>
                    <div className={styles.statNumber}>50+</div>
                    <div className={styles.statLabel}>Programmes réalisés</div>
                  </div>
                  <div className={styles.statItem}>
                    <div className={styles.statNumber}>15</div>
                    <div className={styles.statLabel}>Pays d'intervention</div>
                  </div>
                </>
              )}
            </div>
          </div>
        </section>

        {/* Vision Section - Dynamique */}
        {vision.content && (
          <section className={styles.vision}>
            <div className={styles.container}>
              <div className={styles.visionGrid}>
                <div className={styles.visionContent}>
                  <div className={styles.visionIcon}>
                    {getIcon(vision.icon || 'Eye', styles.visionSvg)}
                  </div>
                  <h2 className={styles.visionTitle}>{vision.title || "Notre Vision"}</h2>
                  <p className={styles.visionText}>{vision.content}</p>
                </div>
                <div className={styles.visionImage}>
                  <img 
                    src={vision.image || "/images/vision-image.jpg"} 
                    alt="Notre vision"
                    onError={(e) => {
                      e.target.src = "https://via.placeholder.com/500x400?text=Notre+Vision";
                    }}
                  />
                </div>
              </div>
            </div>
          </section>
        )}

        {/* Derniers Articles Section */}
        {articles.length > 0 && (
          <section className={styles.articles}>
            <div className={styles.container}>
              <div className={styles.sectionHeader}>
                <h2 className={styles.sectionTitle}>Derniers articles</h2>
                <p className={styles.sectionDescription}>
                  Suivez nos actualités et découvertes
                </p>
              </div>

              <div className={styles.articlesGrid}>
                {articles.slice(0, 3).map(article => (
                  <Card key={article.id} className={styles.articleCard}>
                    <div className={styles.articleImageWrapper}>
                      <img 
                        src={article.image || "/images/default-article.jpg"} 
                        alt={article.title}
                        className={styles.articleImage}
                        onError={(e) => {
                          e.target.src = "https://via.placeholder.com/400x250?text=Article";
                        }}
                      />
                    </div>
                    <CardContent className={styles.articleContent}>
                      <div className={styles.articleMeta}>
                        <span className={styles.articleCategory}>
                          {article.categorie?.name || 'Actualité'}
                        </span>
                        <span className={styles.articleDate}>
                          {new Date(article.published_at || article.created_at).toLocaleDateString('fr-FR', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                          })}
                        </span>
                      </div>
                      <h3 className={styles.articleTitle}>{article.title}</h3>
                      <p className={styles.articleExcerpt}>
                        {article.excerpt || (article.content && article.content.substring(0, 120) + '...')}
                      </p>
                      <Link to={`/articles/${article.id}`} className={styles.readMore}>
                        Lire la suite <ArrowRight className={styles.readMoreIcon} />
                      </Link>
                    </CardContent>
                  </Card>
                ))}
              </div>

              <div className={styles.sectionFooter}>
                <Link to="/nos-actions" className={styles.viewAllLink}>
                  Voir tous les articles
                  <ArrowRight className={styles.viewAllIcon} />
                </Link>
              </div>
            </div>
          </section>
        )}

        {/* Programmes Section */}
        {programmes.length > 0 && (
          <section className={styles.programmes}>
            <div className={styles.container}>
              <div className={styles.sectionHeader}>
                <h2 className={styles.sectionTitle}>Nos programmes</h2>
                <p className={styles.sectionDescription}>
                  Découvrez comment nous agissons concrètement
                </p>
              </div>

              <div className={styles.programmesGrid}>
                {programmes.slice(0, 3).map(programme => (
                  <Card key={programme.id} className={styles.programmeCard}>
                    <div className={styles.programmeImageWrapper}>
                      <img 
                        src={programme.image || "/images/default-program.jpg"} 
                        alt={programme.title}
                        className={styles.programmeImage}
                        onError={(e) => {
                          e.target.src = "https://via.placeholder.com/400x200?text=Programme";
                        }}
                      />
                    </div>
                    <CardContent className={styles.programmeContent}>
                      <div className={styles.programmeMeta}>
                        {programme.location && (
                          <span className={styles.programmeLocation}>
                            <MapPin className={styles.metaIcon} /> {programme.location}
                          </span>
                        )}
                        {programme.start_date && (
                          <span className={styles.programmeDate}>
                            <Calendar className={styles.metaIcon} /> 
                            {new Date(programme.start_date).toLocaleDateString('fr-FR')}
                          </span>
                        )}
                      </div>
                      <h3 className={styles.programmeTitle}>{programme.title}</h3>
                      <p className={styles.programmeDescription}>
                        {programme.description?.substring(0, 100)}...
                      </p>
                      <div className={styles.programmeStatus}>
                        <span className={`${styles.statusBadge} ${programme.is_active ? styles.active : styles.inactive}`}>
                          {programme.is_active ? 'Actif' : 'Inactif'}
                        </span>
                      </div>
                      <Link to={`/programmes/${programme.id}`} className={styles.programmeLink}>
                        En savoir plus <ArrowRight className={styles.linkIcon} />
                      </Link>
                    </CardContent>
                  </Card>
                ))}
              </div>

              <div className={styles.sectionFooter}>
                <Link to="/nos-actions" className={styles.viewAllLink}>
                  Voir tous les programmes
                  <ArrowRight className={styles.viewAllIcon} />
                </Link>
              </div>
            </div>
          </section>
        )}

        {/* Impact Section - Dynamique depuis about */}
        <section className={styles.impact}>
          <div className={styles.container}>
            <div className={styles.impactGrid}>
              <div className={styles.impactImage}>
                <img
                  src={mission.image || "/images/african-youth-community.jpg"}
                  alt="Impact communautaire"
                  onError={(e) => {
                    e.target.src = "https://via.placeholder.com/600x400?text=Impact+Communautaire";
                  }}
                />
              </div>

              <div className={styles.impactContent}>
                <h2 className={styles.impactTitle}>
                  {mission.impactTitle || "Un impact qui transforme des vies"}
                </h2>
                <p className={styles.impactDescription}>
                  {mission.impactDescription || 
                    "Nos programmes touchent directement la vie de milliers de jeunes africains chaque année, leur donnant les outils et la confiance nécessaires pour réaliser leur potentiel."}
                </p>

                <div className={styles.features}>
                  {values.slice(3, 6).map(value => (
                    <div key={value.id} className={styles.feature}>
                      <div className={styles.featureIcon}>
                        {getIcon(value.icon, styles.featureSvg)}
                      </div>
                      <div>
                        <h4 className={styles.featureTitle}>{value.title}</h4>
                        <p className={styles.featureDescription}>{value.description}</p>
                      </div>
                    </div>
                  ))}
                </div>

                <Button size="lg" asChild className={styles.impactButton}>
                  <Link to="/nos-actions">
                    Voir nos programmes
                    <ArrowRight className={styles.buttonIcon} />
                  </Link>
                </Button>
              </div>
            </div>
          </div>
        </section>

        {/* Témoignages Section Dynamique */}
        <section className={styles.testimonials}>
          <div className={styles.container}>
            <div className={styles.testimonialsWrapper}>
              <div className={styles.sectionHeader}>
                <h2 className={styles.sectionTitle}>Témoignages</h2>
                <p className={styles.sectionDescription}>Les voix de ceux qui font la différence</p>
              </div>

              <div className={styles.testimonialsGrid}>
                {temoignages.length > 0 ? (
                  temoignages.slice(0, 2).map(temoignage => (
                    <Card key={temoignage.id} className={styles.testimonialCard}>
                      <CardContent className={styles.testimonialContent}>
                        <div className={styles.testimonialHeader}>
                          <div className={styles.avatar}>
                            {temoignage.name?.charAt(0) || 'T'}
                          </div>
                          <div>
                            <div className={styles.testimonialName}>
                              {temoignage.name || 'Témoin'}
                            </div>
                            <div className={styles.testimonialRole}>
                              {temoignage.fonction || 'Bénéficiaire'}
                            </div>
                          </div>
                        </div>
                        <p className={styles.testimonialText}>
                          "{temoignage.contenu || temoignage.message}"
                        </p>
                      </CardContent>
                    </Card>
                  ))
                ) : (
                  // Témoignages par défaut
                  <>
                    <Card className={styles.testimonialCard}>
                      <CardContent className={styles.testimonialContent}>
                        <div className={styles.testimonialHeader}>
                          <div className={styles.avatar}>A</div>
                          <div>
                            <div className={styles.testimonialName}>Amina K.</div>
                            <div className={styles.testimonialRole}>Bénéficiaire, Sénégal</div>
                          </div>
                        </div>
                        <p className={styles.testimonialText}>
                          "Grâce à YOULIDA, j'ai appris à croire en mes capacités. Aujourd'hui, je suis étudiante en
                          médecine et je veux aider ma communauté."
                        </p>
                      </CardContent>
                    </Card>

                    <Card className={styles.testimonialCard}>
                      <CardContent className={styles.testimonialContent}>
                        <div className={styles.testimonialHeader}>
                          <div className={styles.avatar}>K</div>
                          <div>
                            <div className={styles.testimonialName}>Kwame M.</div>
                            <div className={styles.testimonialRole}>Volontaire, Ghana</div>
                          </div>
                        </div>
                        <p className={styles.testimonialText}>
                          "Être volontaire chez YOULIDA m'a permis de redonner à ma communauté et d'inspirer la prochaine
                          génération de leaders."
                        </p>
                      </CardContent>
                    </Card>
                  </>
                )}
              </div>

              {temoignages.length > 2 && (
                <div className={styles.sectionFooter}>
                  <Link to="/temoignages" className={styles.viewAllLink}>
                    Voir tous les témoignages
                    <ArrowRight className={styles.viewAllIcon} />
                  </Link>
                </div>
              )}
            </div>
          </div>
        </section>

        {/* Partenaires Section */}
        {partenaires.length > 0 && (
          <section className={styles.partenaires}>
            <div className={styles.container}>
              <div className={styles.sectionHeader}>
                <h2 className={styles.sectionTitle}>Nos partenaires</h2>
                <p className={styles.sectionDescription}>Ils nous soutiennent</p>
              </div>

              <div className={styles.partenairesGrid}>
                {partenaires.map(partenaire => (
                  <div key={partenaire.id} className={styles.partenaireItem}>
                    {partenaire.logo ? (
                      <img 
                        src={partenaire.logo} 
                        alt={partenaire.nom}
                        onError={(e) => {
                          e.target.style.display = 'none';
                          e.target.parentElement.innerHTML = partenaire.nom;
                        }}
                      />
                    ) : (
                      <span className={styles.partenaireNom}>{partenaire.nom}</span>
                    )}
                  </div>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* Équipe Section */}
        {equipe.length > 0 && (
          <section className={styles.equipe}>
            <div className={styles.container}>
              <div className={styles.sectionHeader}>
                <h2 className={styles.sectionTitle}>Notre équipe</h2>
                <p className={styles.sectionDescription}>Les personnes derrière YOULIDA</p>
              </div>

              <div className={styles.equipeGrid}>
                {equipe.slice(0, 4).map(membre => (
                  <div key={membre.id} className={styles.equipeCard}>
                    {membre.photo ? (
                      <img 
                        src={membre.photo} 
                        alt={membre.name} 
                        className={styles.equipePhoto}
                        onError={(e) => {
                          e.target.src = "https://via.placeholder.com/150?text=" + membre.name.charAt(0);
                        }}
                      />
                    ) : (
                      <div className={styles.equipePhotoPlaceholder}>
                        {membre.name?.charAt(0) || 'M'}
                      </div>
                    )}
                    <h3 className={styles.equipeName}>{membre.name}</h3>
                    <p className={styles.equipeRole}>{membre.role}</p>
                  </div>
                ))}
              </div>

              <div className={styles.sectionFooter}>
                <Link to="/a-propos" className={styles.viewAllLink}>
                  Voir toute l'équipe
                  <ArrowRight className={styles.viewAllIcon} />
                </Link>
              </div>
            </div>
          </section>
        )}

        {/* CTA Section */}
        <section className={styles.cta}>
          <div className={styles.container}>
            <div className={styles.ctaContent}>
              <h2 className={styles.ctaTitle}>Rejoignez le mouvement</h2>
              <p className={styles.ctaDescription}>
                Que vous souhaitiez devenir bénévole, faire un don ou simplement en savoir plus, votre soutien fait la
                différence.
              </p>
              <div className={styles.ctaButtons}>
                <Button size="lg" variant="secondary" asChild className={styles.ctaButton}>
                  <Link to="/s-impliquer">Devenir bénévole</Link>
                </Button>
                <Button size="lg" variant="outline" asChild className={styles.ctaButtonOutline}>
                  <Link to="/s-impliquer#dons">Faire un don</Link>
                </Button>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  );
}