import React, { useState } from "react";
import {
  Mail,
  Phone,
  MessageCircle,
  Facebook,
  Linkedin,
  Twitter,
  Send,
} from "lucide-react";

import "./ContactPage.css";

export default function ContactPage() {

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    subject: "",
    message: "",
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    /*
     * L'envoi au backend Laravel sera branché ici.
     */
    console.log(formData);
  };

  return (
    <div className="contact-page">

      {/* =========================================
          HERO
      ========================================== */}
      <header className="contact-hero">

        <span className="contact-badge">
          Nous contacter
        </span>

        <h1>
          Contactez YOULIDA
        </h1>

        <p>
          Une question, une demande d'information ou simplement
          besoin d'entrer en contact avec notre équipe ?
          Écrivez-nous ou utilisez l'un de nos moyens de contact.
        </p>

      </header>


      {/* =========================================
          COORDONNÉES
      ========================================== */}
      <section className="contact-info">

        {/* EMAIL */}
        <a
          href="mailto:contact@youlida.org"
          className="info-card"
        >

          <div className="icon">
            <Mail size={28} />
          </div>

          <h3>Email</h3>

          <p>
            contact@youlida.org
          </p>

          <span className="contact-action">
            Envoyer un email
          </span>

        </a>


        {/* TÉLÉPHONE */}
        <a
          href="tel:+22673525290"
          className="info-card"
        >

          <div className="icon">
            <Phone size={28} />
          </div>

          <h3>Téléphone</h3>

          <p>
            +226 73 52 52 90
          </p>

          <span className="contact-action">
            Appeler YOULIDA
          </span>

        </a>


        {/* WHATSAPP */}
        <a
          href="https://wa.me/message/V2TTCFZB6NFIB1"
          target="_blank"
          rel="noopener noreferrer"
          className="info-card"
        >

          <div className="icon">
            <MessageCircle size={28} />
          </div>

          <h3>WhatsApp</h3>

          <p>
            Échangez directement avec YOULIDA
          </p>

          <span className="contact-action">
            Ouvrir WhatsApp
          </span>

        </a>

      </section>


      {/* =========================================
          FORMULAIRE DE CONTACT
      ========================================== */}
      <section className="contact-form-section">

        <div className="contact-form-header">

          <span className="contact-badge">
            Écrivez-nous
          </span>

          <h2>
            Envoyez-nous un message
          </h2>

          <p>
            Utilisez ce formulaire pour toute demande générale
            adressée à YOULIDA.
          </p>

        </div>


        <form
          className="contact-form"
          onSubmit={handleSubmit}
        >

          <div className="form-group">

            <label htmlFor="name">
              Nom complet
            </label>

            <input
              id="name"
              name="name"
              type="text"
              placeholder="Votre nom complet"
              value={formData.name}
              onChange={handleChange}
              required
            />

          </div>


          <div className="form-group">

            <label htmlFor="email">
              Adresse email
            </label>

            <input
              id="email"
              name="email"
              type="email"
              placeholder="exemple@email.com"
              value={formData.email}
              onChange={handleChange}
              required
            />

          </div>


          <div className="form-group">

            <label htmlFor="subject">
              Objet
            </label>

            <input
              id="subject"
              name="subject"
              type="text"
              placeholder="Objet de votre message"
              value={formData.subject}
              onChange={handleChange}
            />

          </div>


          <div className="form-group">

            <label htmlFor="message">
              Message
            </label>

            <textarea
              id="message"
              name="message"
              rows="6"
              placeholder="Écrivez votre message..."
              value={formData.message}
              onChange={handleChange}
              required
            />

          </div>


          <button
            type="submit"
            className="btn-submit"
          >
            <Send size={18} />

            Envoyer le message
          </button>

        </form>

      </section>


      {/* =========================================
          AUTRES BESOINS
      ========================================== */}
      <section className="contact-orientation">

        <div className="contact-form-header">

          <span className="contact-badge">
            Vous souhaitez agir ?
          </span>

          <h2>
            Vous avez une demande spécifique ?
          </h2>

          <p>
            YOULIDA dispose d'un espace dédié aux demandes
            d'accompagnement et aux différentes formes
            d'engagement.
          </p>

        </div>


        <div className="orientation-grid">

          <a
            href="/call-to-action"
            className="orientation-card"
          >
            <MessageCircle size={26} />

            <h3>
              Besoin de parler ?
            </h3>

            <p>
              Accédez à l'espace prévu pour les jeunes
              souhaitant échanger avec YOULIDA.
            </p>

            <span>
              Accéder à l'espace →
            </span>
          </a>


          <a
            href="/call-to-action"
            className="orientation-card"
          >
            <MessageCircle size={26} />

            <h3>
              Devenir partenaire
            </h3>

            <p>
              Découvrez l'espace consacré aux demandes
              de partenariat et de collaboration.
            </p>

            <span>
              Proposer un partenariat →
            </span>
          </a>


          <a
            href="/call-to-action"
            className="orientation-card"
          >
            <MessageCircle size={26} />

            <h3>
              Solliciter YOULIDA
            </h3>

            <p>
              Adressez une demande d'intervention
              à l'équipe YOULIDA.
            </p>

            <span>
              Faire une demande →
            </span>
          </a>

        </div>

      </section>


      {/* =========================================
          RÉSEAUX SOCIAUX
      ========================================== */}
      <section className="contact-social">

        <div className="contact-form-header">

          <span className="contact-badge">
            Réseaux sociaux
          </span>

          <h2>
            Suivez YOULIDA
          </h2>

          <p>
            Retrouvez également YOULIDA sur ses plateformes
            sociales officielles.
          </p>

        </div>


        <div className="social-contact-links">

          <a
            href="https://www.facebook.com/youlida.bfa"
            target="_blank"
            rel="noopener noreferrer"
            className="social-contact-link"
          >
            <Facebook size={22} />

            Facebook
          </a>


          <a
            href="https://www.linkedin.com/company/102186032/"
            target="_blank"
            rel="noopener noreferrer"
            className="social-contact-link"
          >
            <Linkedin size={22} />

            LinkedIn
          </a>


          <a
            href="https://x.com/YOULIDAbf"
            target="_blank"
            rel="noopener noreferrer"
            className="social-contact-link"
          >
            <Twitter size={22} />

            X
          </a>

        </div>

      </section>

    </div>
  );
}