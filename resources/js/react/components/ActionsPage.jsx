import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import {
  Calendar,
  User,
  ArrowRight,
  BookOpen,
  Heart,
  Users,
  Sparkles,
  ChevronLeft,
  ChevronRight,
} from "lucide-react";
import "./ActionsPage.css";

export default function ActionsPage() {
  const articles = window.LaravelData?.articles || [];
  const programmes = window.LaravelData?.programmes || [];

  const articlesPublies = articles.filter((a) => a.is_published);

  const sliderArticles =
    articlesPublies.length > 1
      ? [
          articlesPublies[articlesPublies.length - 1],
          ...articlesPublies,
          articlesPublies[0],
        ]
      : articlesPublies;

  const [currentSlide, setCurrentSlide] = useState(
    articlesPublies.length > 1 ? 1 : 0
  );
  const [transitionEnabled, setTransitionEnabled] = useState(true);

  useEffect(() => {
    if (articlesPublies.length <= 1) return;

    const interval = setInterval(() => {
      setTransitionEnabled(true);
      setCurrentSlide((prev) => prev + 1);
    }, 3000);

    return () => clearInterval(interval);
  }, [articlesPublies.length]);

  useEffect(() => {
    if (articlesPublies.length <= 1) return;

    if (currentSlide === sliderArticles.length - 1) {
      const timeout = setTimeout(() => {
        setTransitionEnabled(false);
        setCurrentSlide(1);
      }, 700);

      return () => clearTimeout(timeout);
    }

    if (currentSlide === 0) {
      const timeout = setTimeout(() => {
        setTransitionEnabled(false);
        setCurrentSlide(articlesPublies.length);
      }, 700);

      return () => clearTimeout(timeout);
    }
  }, [currentSlide, sliderArticles.length, articlesPublies.length]);

  useEffect(() => {
    if (!transitionEnabled) {
      const timeout = setTimeout(() => {
        setTransitionEnabled(true);
      }, 50);

      return () => clearTimeout(timeout);
    }
  }, [transitionEnabled]);

  const nextSlide = () => {
    if (articlesPublies.length <= 1) return;
    setTransitionEnabled(true);
    setCurrentSlide((prev) => prev + 1);
  };

  const prevSlide = () => {
    if (articlesPublies.length <= 1) return;
    setTransitionEnabled(true);
    setCurrentSlide((prev) => prev - 1);
  };

  const activeDot =
    articlesPublies.length <= 1
      ? 0
      : currentSlide === 0
      ? articlesPublies.length - 1
      : currentSlide === sliderArticles.length - 1
      ? 0
      : currentSlide - 1;

  const programmesParCategorie = {
    education: programmes.filter(
      (p) =>
        p.categorie === "education" ||
        p.title?.toLowerCase().includes("éducation")
    ),
    sante: programmes.filter(
      (p) =>
        p.categorie === "sante" || p.title?.toLowerCase().includes("santé")
    ),
    leadership: programmes.filter(
      (p) =>
        p.categorie === "leadership" ||
        p.title?.toLowerCase().includes("leadership")
    ),
    communautaire: programmes.filter(
      (p) =>
        p.categorie === "communautaire" ||
        p.title?.toLowerCase().includes("communautaire")
    ),
  };

  const stats = {
    jeunes: articles.reduce((sum, a) => sum + (a.stats?.jeunes || 0), 0) || 2500,
    programmes: programmes.length || 150,
    communautes:
      programmes.reduce((sum, p) => sum + (p.stats?.communautes || 0), 0) || 30,
  };

  const sections = [
    {
      id: "education",
      title: "Programme Éducation",
      icon: <BookOpen size={40} color="#e63946" />,
      data: programmesParCategorie.education,
      defaultDescription:
        "Nous accompagnons les jeunes dans leurs choix éducatifs et professionnels à travers des ateliers d'orientation, du mentorat et des bourses d'études.",
      defaultList: [
        "<strong>Ateliers d'orientation :</strong> Découvrir les métiers et filières d'études",
        "<strong>Mentorat académique :</strong> Accompagnement par des professionnels",
        "<strong>Bourses d'études :</strong> Soutien financier pour les jeunes méritants",
      ],
      defaultImage: "/african-students-studying-together-in-classroom.jpg",
      stats: [
        { value: stats.jeunes + "+", label: "Jeunes orientés" },
        { value: articlesPublies.length + "+", label: "Articles publiés" },
      ],
      imagePosition: "right",
    },
    {
      id: "sante",
      title: "Programme Santé",
      icon: <Heart size={40} color="#e63946" />,
      data: programmesParCategorie.sante,
      defaultDescription:
        "Des programmes de sensibilisation et d'éducation sur la santé reproductive, la prévention des IST et le bien-être mental.",
      defaultList: [
        "Éducation sexuelle complète",
        "Prévention VIH/SIDA",
        "Soutien psychologique",
      ],
      defaultImage: "/african-youth-health-education-workshop.jpg",
      stats: [
        {
          value: "8,000+",
          label: "Jeunes sensibilisés",
        },
        {
          value: programmesParCategorie.sante.length + "+",
          label: "Ateliers organisés",
        },
      ],
      imagePosition: "left",
    },
    {
      id: "leadership",
      title: "Programme Leadership",
      icon: <Sparkles size={40} color="#e63946" />,
      data: programmesParCategorie.leadership,
      defaultDescription:
        "Développer les compétences en leadership, entrepreneuriat et engagement civique.",
      defaultList: [
        "Camps de leadership",
        "Entrepreneuriat jeunesse",
        "Engagement civique",
      ],
      defaultImage: "/african-youth-leadership-training-workshop.jpg",
      stats: [
        { value: "500+", label: "Leaders formés" },
        { value: "80", label: "Projets lancés" },
      ],
      imagePosition: "right",
    },
    {
      id: "communautaire",
      title: "Programme Communautaire",
      icon: <Users size={40} color="#e63946" />,
      data: programmesParCategorie.communautaire,
      defaultDescription:
        "Mobiliser les jeunes pour des projets qui répondent aux besoins de leurs communautés.",
      defaultList: [
        "Projets communautaires",
        "Volontariat jeunesse",
        "Partenariats locaux",
      ],
      defaultImage: "/african-community-development-project-volunteers.jpg",
      stats: [
        { value: stats.communautes + "+", label: "Projets réalisés" },
        {
          value: programmesParCategorie.communautaire.length + "+",
          label: "Communautés touchées",
        },
      ],
      imagePosition: "left",
    },
  ];

  return (
    <div className="programs-page">
      <header className="header">
        <h1 className="header-title">Nos Actions</h1>
        <p className="header-subtitle">
          Des programmes innovants pour transformer la vie des jeunes africains
        </p>

        {articlesPublies.length > 0 && (
          <div className="latest-news">
            <h3>Dernières actualités</h3>

            <div className="news-slider">
              {articlesPublies.length > 1 && (
                <button className="slider-btn left" onClick={prevSlide}>
                  <ChevronLeft size={22} />
                </button>
              )}

              <div className="news-slider-window">
                <div
                  className="news-slider-track"
                  style={{
                    transform: `translateX(-${currentSlide * 100}%)`,
                    transition: transitionEnabled
                      ? "transform 0.7s ease-in-out"
                      : "none",
                  }}
                >
                  {sliderArticles.map((article, index) => (
                    <div key={`${article.id}-${index}`} className="news-slide">
                      <div className="news-card news-card-slider">
                        {article.image && (
                          <img
                            src={article.image}
                            alt={article.title}
                            className="news-image"
                          />
                        )}

                        <div className="news-content">
                          <h4>{article.title}</h4>
                          <p className="news-excerpt">
                            {article.excerpt ||
                              `${article.content?.substring(0, 120) || ""}...`}
                          </p>

                          <div className="news-meta">
                            <span>
                              <Calendar size={14} />
                              {new Date(
                                article.published_at || article.created_at
                              ).toLocaleDateString("fr-FR")}
                            </span>
                            <span>
                              <User size={14} />
                              {article.user?.name || "Admin"}
                            </span>
                          </div>

                          <Link
                            to={`/articles/${article.id}`}
                            className="read-more"
                          >
                            Lire la suite <ArrowRight size={14} />
                          </Link>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {articlesPublies.length > 1 && (
                <button className="slider-btn right" onClick={nextSlide}>
                  <ChevronRight size={22} />
                </button>
              )}
            </div>

            {articlesPublies.length > 1 && (
              <div className="slider-dots">
                {articlesPublies.map((_, index) => (
                  <button
                    key={index}
                    className={`dot ${activeDot === index ? "active" : ""}`}
                    onClick={() => {
                      setTransitionEnabled(true);
                      setCurrentSlide(index + 1);
                    }}
                  />
                ))}
              </div>
            )}
          </div>
        )}
      </header>

     {sections.map((section, index) => (
  <section
    key={section.id}
    className={`program-section ${index % 2 === 1 ? "alt" : ""}`}
  >
    <div className="program-content">
      {section.imagePosition === "left" ? (
        <>
          <div className="program-image">
            <img
              src={section.data[0]?.image || section.defaultImage}
              alt={section.title}
              onError={(e) => {
                e.target.src = `https://via.placeholder.com/600x400?text=${section.title.replace(
                  "Programme ",
                  ""
                )}`;
              }}
            />
          </div>

          <div className="program-text">
            <div className="program-icon">{section.icon}</div>
            <h2 className="program-title">{section.title}</h2>

            {section.data.length > 0 ? (
              <>
                {/* Informations du programme */}
                {section.data.slice(0, 1).map((prog) => (
                  <div key={prog.id} className="program-details">
                    {/* Description principale */}
                    <p className="program-description">
                      {prog.description || prog.short_description || section.defaultDescription}
                    </p>

                    {/* Informations complémentaires */}
                    <div className="program-info">
                      {prog.location && (
                        <p className="program-location">
                          <strong>Lieu :</strong> {prog.location}
                        </p>
                      )}

                      {prog.start_date && (
                        <p className="program-dates">
                          <strong>Du :</strong> {new Date(prog.start_date).toLocaleDateString('fr-FR')}
                          {prog.end_date && (
                            <> <strong>au :</strong> {new Date(prog.end_date).toLocaleDateString('fr-FR')}</>
                          )}
                        </p>
                      )}
                    </div>

                    {/* Liste des points clés (si disponible) */}
                    {prog.highlights && prog.highlights.length > 0 ? (
                      <ul className="program-list">
                        {prog.highlights.slice(0, 3).map((highlight, i) => (
                          <li key={i}>{highlight}</li>
                        ))}
                      </ul>
                    ) : (
                      <ul className="program-list">
                        {section.defaultList.map((item, i) => (
                          <li key={i} dangerouslySetInnerHTML={{ __html: item }} />
                        ))}
                      </ul>
                    )}
                  </div>
                ))}

                {/* Statistiques */}
                <div className="program-stats">
                  {section.stats.map((stat, i) => (
                    <div key={i}>
                      <h3>{stat.value}</h3>
                      <p>{stat.label}</p>
                    </div>
                  ))}
                </div>
              </>
            ) : (
              // Fallback si aucun programme
              <>
                <p className="program-description">{section.defaultDescription}</p>
                <ul className="program-list">
                  {section.defaultList.map((item, i) => (
                    <li key={i} dangerouslySetInnerHTML={{ __html: item }} />
                  ))}
                </ul>
                <div className="program-stats">
                  {section.stats.map((stat, i) => (
                    <div key={i}>
                      <h3>{stat.value}</h3>
                      <p>{stat.label}</p>
                    </div>
                  ))}
                </div>
              </>
            )}
          </div>
        </>
      ) : (
        // Même structure pour l'image à droite
        <>
          <div className="program-text">
            <div className="program-icon">{section.icon}</div>
            <h2 className="program-title">{section.title}</h2>

            {section.data.length > 0 ? (
              <>
                {section.data.slice(0, 1).map((prog) => (
                  <div key={prog.id} className="program-details">
                    <p className="program-description">
                      {prog.description || prog.short_description || section.defaultDescription}
                    </p>

                    <div className="program-info">
                      {prog.location && (
                        <p className="program-location">
                          <strong>Lieu :</strong> {prog.location}
                        </p>
                      )}

                      {prog.start_date && (
                        <p className="program-dates">
                          <strong>Du :</strong> {new Date(prog.start_date).toLocaleDateString('fr-FR')}
                          {prog.end_date && (
                            <> <strong>au :</strong> {new Date(prog.end_date).toLocaleDateString('fr-FR')}</>
                          )}
                        </p>
                      )}
                    </div>

                    {prog.highlights && prog.highlights.length > 0 ? (
                      <ul className="program-list">
                        {prog.highlights.slice(0, 3).map((highlight, i) => (
                          <li key={i}>{highlight}</li>
                        ))}
                      </ul>
                    ) : (
                      <ul className="program-list">
                        {section.defaultList.map((item, i) => (
                          <li key={i} dangerouslySetInnerHTML={{ __html: item }} />
                        ))}
                      </ul>
                    )}
                  </div>
                ))}

                <div className="program-stats">
                  {section.stats.map((stat, i) => (
                    <div key={i}>
                      <h3>{stat.value}</h3>
                      <p>{stat.label}</p>
                    </div>
                  ))}
                </div>
              </>
            ) : (
              // Fallback
              <>
                <p className="program-description">{section.defaultDescription}</p>
                <ul className="program-list">
                  {section.defaultList.map((item, i) => (
                    <li key={i} dangerouslySetInnerHTML={{ __html: item }} />
                  ))}
                </ul>
                <div className="program-stats">
                  {section.stats.map((stat, i) => (
                    <div key={i}>
                      <h3>{stat.value}</h3>
                      <p>{stat.label}</p>
                    </div>
                  ))}
                </div>
              </>
            )}
          </div>

          <div className="program-image">
            <img
              src={section.data[0]?.image || section.defaultImage}
              alt={section.title}
              onError={(e) => {
                e.target.src = `https://via.placeholder.com/600x400?text=${section.title.replace(
                  "Programme ",
                  ""
                )}`;
              }}
            />
          </div>
        </>
      )}
    </div>
  </section>
))}
      {articlesPublies.length > 3 && (
        <section className="articles-section">
          <div className="container">
            <h2 className="section-title">Tous nos articles</h2>
            <div className="articles-grid">
              {articlesPublies.slice(3).map((article) => (
                <div key={article.id} className="article-card">
                  {article.image && (
                    <img src={article.image} alt={article.title} />
                  )}
                  <h3>{article.title}</h3>
                  <p>{article.excerpt || article.content?.substring(0, 80)}...</p>
                  <Link to={`/articles/${article.id}`} className="read-more">
                    Lire <ArrowRight size={14} />
                  </Link>
                </div>
              ))}
            </div>
          </div>
        </section>
      )}

      <section className="cta-section">
        <h2>Soutenez nos programmes</h2>
        <p>
          Votre contribution permet de toucher encore plus de jeunes et de créer
          un impact durable.
        </p>
        <div className="cta-buttons">
          <a href="/s-impliquer" className="btn-primary">
            Faire un don
          </a>
          <a href="/s-impliquer" className="btn-outline">
            Devenir bénévole
          </a>
        </div>
      </section>
    </div>
  );
}
