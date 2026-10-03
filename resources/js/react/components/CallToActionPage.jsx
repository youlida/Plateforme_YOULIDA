import React, { useEffect, useRef, useState } from "react";
import "./CallToActionPage.css";

import {
    MessageCircle,
    Handshake,
    Megaphone,
    Heart,
    ArrowRight,
    Phone,
    Gift,
    X,
} from "lucide-react";

export default function CallToActionPage() {
    const [showYouthForm, setShowYouthForm] = useState(false);
    const [wantsCallback, setWantsCallback] = useState("non");
    const [isRecording, setIsRecording] = useState(false);
    const [audioURL, setAudioURL] = useState(null);
    const [audioBlob, setAudioBlob] = useState(null);
    const [audioError, setAudioError] = useState("");

    const mediaRecorderRef = useRef(null);
    const audioChunksRef = useRef([]);
    const streamRef = useRef(null);
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitSuccess, setSubmitSuccess] = useState("");
    const [submitError, setSubmitError] = useState("");
    const [showPartnerForm, setShowPartnerForm] = useState(false);

    const [partnerSubmitting, setPartnerSubmitting] = useState(false);
    const [partnerSuccess, setPartnerSuccess] = useState("");
    const [partnerError, setPartnerError] = useState("");

    const [showInterventionForm, setShowInterventionForm] = useState(false);
    const [interventionFormat, setInterventionFormat] = useState("ponctuelle");

    const [interventionSubmitting, setInterventionSubmitting] = useState(false);
    const [interventionSuccess, setInterventionSuccess] = useState("");
    const [interventionError, setInterventionError] = useState("");

    const [showVolunteerForm, setShowVolunteerForm] = useState(false);
    const [volunteerLoading, setVolunteerLoading] = useState(false);
    const [volunteerSuccess, setVolunteerSuccess] = useState("");
    const [volunteerError, setVolunteerError] = useState("");

    const [showDonationSection, setShowDonationSection] = useState(false);

    const hasOpenModal =
        showYouthForm ||
        showPartnerForm ||
        showInterventionForm ||
        showVolunteerForm ||
        showDonationSection;

    useEffect(() => {
        if (hasOpenModal) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }

        return () => {
            document.body.style.overflow = "";
        };
    }, [hasOpenModal]);

    useEffect(() => {
        const handleEscape = (event) => {
            if (event.key !== "Escape") return;

            setShowYouthForm(false);
            setShowPartnerForm(false);
            setShowInterventionForm(false);
            setShowVolunteerForm(false);
            setShowDonationSection(false);
        };

        document.addEventListener("keydown", handleEscape);

        return () => {
            document.removeEventListener("keydown", handleEscape);
        };
    }, []);

    const closeAllModals = () => {
        setShowYouthForm(false);
        setShowPartnerForm(false);
        setShowInterventionForm(false);
        setShowVolunteerForm(false);
        setShowDonationSection(false);
    };

    const openYouthModal = () => {
        closeAllModals();
        setSubmitError("");
        setSubmitSuccess("");
        setShowYouthForm(true);
    };

    const openPartnerModal = () => {
        closeAllModals();
        setPartnerSuccess("");
        setPartnerError("");
        setShowPartnerForm(true);
    };

    const openInterventionModal = () => {
        closeAllModals();
        setInterventionSuccess("");
        setInterventionError("");
        setShowInterventionForm(true);
    };

    const openVolunteerModal = () => {
        closeAllModals();
        setVolunteerSuccess("");
        setVolunteerError("");
        setShowVolunteerForm(true);
    };

    const openDonationModal = () => {
        closeAllModals();
        setShowDonationSection(true);
    };



    const startRecording = async () => {
        try {
            setAudioError("");

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                setAudioError(
                    "L'enregistrement audio n'est pas disponible sur ce navigateur."
                );
                return;
            }

            // Supprime l'ancien enregistrement
            if (audioURL) {
                URL.revokeObjectURL(audioURL);
                setAudioURL(null);
                setAudioBlob(null);
            }

            // Demande l'autorisation d'utiliser le microphone
            const stream = await navigator.mediaDevices.getUserMedia({
                audio: true,
            });

            streamRef.current = stream;

            const mediaRecorder = new MediaRecorder(stream);

            mediaRecorderRef.current = mediaRecorder;
            audioChunksRef.current = [];

            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    audioChunksRef.current.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                const audio = new Blob(audioChunksRef.current, {
                    type: mediaRecorder.mimeType || "audio/webm",
                });

                const url = URL.createObjectURL(audio);

                setAudioBlob(audio);
                setAudioURL(url);

                // Coupe réellement le microphone
                stream.getTracks().forEach((track) => track.stop());
                streamRef.current = null;
            };

            mediaRecorder.start();

            setIsRecording(true);
        } catch (error) {
            console.error("Erreur microphone :", error);

            setAudioError(
                "Impossible d'accéder au microphone. Vérifiez l'autorisation du navigateur."
            );
        }
    };
    const handleYouthSubmit = async (e) => {
        e.preventDefault();

        setSubmitError("");
        setSubmitSuccess("");

        const form = e.currentTarget;

        const message = form.elements.message?.value.trim() || "";
        const category = form.elements.category?.value || "";

        // Il faut au minimum un texte ou un vocal
        if (!message && !audioBlob) {
            setSubmitError(
                "Écrivez un message ou enregistrez un message vocal avant d'envoyer."
            );
            return;
        }

        const formData = new FormData();

        if (message) {
            formData.append("message", message);
        }

        if (category) {
            formData.append("category", category);
        }

        if (audioBlob) {
            const extension = audioBlob.type.includes("ogg")
                ? "ogg"
                : audioBlob.type.includes("mp4")
                    ? "m4a"
                    : "webm";

            formData.append(
                "audio",
                audioBlob,
                `message-vocal.${extension}`
            );
        }

        const callbackRequested = wantsCallback === "oui";

        formData.append(
            "wants_callback",
            callbackRequested ? "1" : "0"
        );

        if (callbackRequested) {
            formData.append(
                "callback_channel",
                form.elements.callbackChannel?.value || ""
            );

            formData.append(
                "contact",
                form.elements.contact?.value.trim() || ""
            );

            formData.append(
                "callback_time",
                form.elements.callbackTime?.value || ""
            );
        }

        try {
            setIsSubmitting(true);

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content");

            if (!csrfToken) {
                throw new Error(
                    "Le jeton de sécurité CSRF est introuvable. Rechargez la page."
                );
            }

            const response = await fetch("/youth-messages", {
                method: "POST",

                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: formData,
            });

            const data = await response.json();

            if (response.status === 429) {
                throw new Error(
                    "Trop de demandes ont été envoyées. Veuillez patienter quelques minutes avant de réessayer."
                );
            }
            if (!response.ok) {
                if (data.errors) {
                    const firstError = Object.values(data.errors)[0];

                    throw new Error(
                        Array.isArray(firstError)
                            ? firstError[0]
                            : firstError
                    );
                }

                throw new Error(
                    data.message || "Impossible d'envoyer le message."
                );
            }

            setSubmitSuccess(
                `Votre message a bien été envoyé. Référence : ${data.reference}`
            );

            // Réinitialiser le formulaire
            form.reset();

            setWantsCallback("non");

            if (audioURL) {
                URL.revokeObjectURL(audioURL);
            }

            setAudioURL(null);
            setAudioBlob(null);
            setAudioError("");
            audioChunksRef.current = [];

        } catch (error) {
            console.error(error);

            setSubmitError(
                error.message ||
                "Une erreur est survenue pendant l'envoi."
            );
        } finally {
            setIsSubmitting(false);
        }
    };


    const handlePartnerSubmit = async (event) => {
        event.preventDefault();

        setPartnerSubmitting(true);
        setPartnerSuccess("");
        setPartnerError("");

        const form = event.currentTarget;
        const formData = new FormData(form);

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        try {
            const response = await fetch("/partnership-requests", {
                method: "POST",

                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    const firstError =
                        Object.values(data.errors)[0]?.[0];

                    throw new Error(
                        firstError ||
                        "Veuillez vérifier les informations saisies."
                    );
                }

                throw new Error(
                    data.message ||
                    "Une erreur est survenue pendant l'envoi."
                );
            }

            setPartnerSuccess(
                `Votre proposition a bien été envoyée. Référence : ${data.reference}`
            );

            form.reset();

        } catch (error) {
            console.error(error);

            setPartnerError(
                error.message ||
                "Impossible d'envoyer votre proposition."
            );

        } finally {
            setPartnerSubmitting(false);
        }
    };


    const handleInterventionSubmit = async (event) => {
        event.preventDefault();

        setInterventionSubmitting(true);
        setInterventionSuccess("");
        setInterventionError("");

        const form = event.currentTarget;
        const formData = new FormData(form);

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        try {
            const response = await fetch("/intervention-requests", {
                method: "POST",

                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    const firstError =
                        Object.values(data.errors)[0]?.[0];

                    throw new Error(
                        firstError ||
                        "Veuillez vérifier les informations saisies."
                    );
                }

                throw new Error(
                    data.message ||
                    "Une erreur est survenue pendant l'envoi."
                );
            }

            setInterventionSuccess(
                `Votre demande d’intervention a bien été envoyée. Référence : ${data.reference}`
            );

            form.reset();

            setInterventionFormat("ponctuelle");

        } catch (error) {
            console.error(error);

            setInterventionError(
                error.message ||
                "Impossible d'envoyer votre demande."
            );

        } finally {
            setInterventionSubmitting(false);
        }
    };


    const handleVolunteerSubmit = async (event) => {
        event.preventDefault();

        setVolunteerLoading(true);
        setVolunteerSuccess("");
        setVolunteerError("");

        const form = event.currentTarget;
        const formData = new FormData(form);

        try {
            const response = await fetch("/benevoles", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: formData,
            });

            const data = await response.json();

            if (response.status === 429) {
                throw new Error(
                    "Trop de demandes ont été envoyées. Veuillez patienter quelques minutes avant de réessayer."
                );
            }

            if (!response.ok) {
                throw new Error(
                    data.message ||
                    "Une erreur est survenue lors de l'envoi."
                );
            }

            setVolunteerSuccess(
                data.message ||
                "Votre demande de bénévolat a bien été envoyée."
            );

            form.reset();
        } catch (error) {
            setVolunteerError(
                error.message ||
                "Impossible d'envoyer votre demande."
            );
        } finally {
            setVolunteerLoading(false);
        }
    };

    const stopRecording = () => {
        if (
            mediaRecorderRef.current &&
            mediaRecorderRef.current.state !== "inactive"
        ) {
            mediaRecorderRef.current.stop();
        }

        setIsRecording(false);
    };

    const resetRecording = () => {
        if (audioURL) {
            URL.revokeObjectURL(audioURL);
        }

        setAudioURL(null);
        setAudioBlob(null);
        setAudioError("");
        audioChunksRef.current = [];
    };
    return (
        <div className="cta-page">

            {/* =========================
          HERO
      ========================= */}
            <section className="cta-hero">
                <div className="cta-hero-content">

                    <span className="cta-hero-badge">
                        YOULIDA
                    </span>

                    <h1>
                        Comment pouvons-nous
                        <span> vous accompagner ?</span>
                    </h1>

                    <p>
                        Que vous soyez jeune, partenaire ou que vous souhaitiez
                        solliciter une intervention, choisissez le parcours
                        qui correspond à votre besoin.
                    </p>

                </div>
            </section>


            {/* =========================
          LES 3 PARCOURS
      ========================= */}
            <section className="cta-paths">

                <div className="cta-section-header">
                    <span className="cta-section-label">
                        NOS PARCOURS
                    </span>

                    <h2>
                        Choisissez votre besoin
                    </h2>

                    <p>
                        Chaque parcours est conçu pour vous permettre de contacter
                        YOULIDA simplement et directement.
                    </p>
                </div>


                <div className="cta-paths-grid">

                    {/* =========================
              PARCOURS 1
          ========================= */}
                    <article className="cta-card cta-card-youth">

                        <div className="cta-card-icon">
                            <MessageCircle size={30} />
                        </div>

                        <span className="cta-card-number">
                            01
                        </span>

                        <h3>
                            Besoin de parler ?
                        </h3>

                        <p className="cta-card-subtitle">
                            Pour les adolescents et les jeunes
                        </p>

                        <p>
                            Une question, une difficulté, une situation que vous
                            vivez ou qui concerne un proche ? Contactez YOULIDA
                            de la manière qui vous convient.
                        </p>

                        <div className="cta-card-actions">

                            <a
                                href="https://wa.me/message/V2TTCFZB6NFIB1"
                                className="cta-action primary"
                                target="_blank"
                                rel="noreferrer"
                            >
                                <MessageCircle size={18} />
                                WhatsApp
                            </a>

                            <a
                                href="tel:+22673525290"
                                className="cta-action secondary"
                            >
                                <Phone size={18} />
                                Appeler
                            </a>

                        </div>

                        <button
                            type="button"
                            className="cta-card-link"
                            onClick={openYouthModal}
                        >
                            {showYouthForm ? "Fermer le formulaire" : "Écrire ou envoyer un message"}
                            <ArrowRight size={18} />
                        </button>

                    </article>


                    {/* =========================
              PARCOURS 2
          ========================= */}
                    <article className="cta-card cta-card-partner">

                        <div className="cta-card-icon">
                            <Handshake size={30} />
                        </div>

                        <span className="cta-card-number">
                            02
                        </span>

                        <h3>
                            Devenir partenaire / Collaborer
                        </h3>

                        <p className="cta-card-subtitle">
                            Construisons ensemble une action
                        </p>

                        <p>
                            Vous souhaitez soutenir une initiative, apporter vos
                            compétences ou ressources, financer une action ou
                            construire un projet avec YOULIDA ?
                        </p>

                        <div className="cta-card-tags">

                            <span>Financement</span>
                            <span>Expertise</span>
                            <span>Ressources</span>
                            <span>Projet conjoint</span>

                        </div>

                        <button
                            type="button"
                            className="cta-card-button"
                            onClick={openPartnerModal}
                        >
                            {showPartnerForm
                                ? "Fermer le formulaire"
                                : "Devenir partenaire"}
                        </button>

                    </article>


                    {/* =========================
              PARCOURS 3
          ========================= */}
                    <article className="cta-card cta-card-intervention">

                        <div className="cta-card-icon">
                            <Megaphone size={30} />
                        </div>

                        <span className="cta-card-number">
                            03
                        </span>

                        <h3>
                            Solliciter une intervention
                        </h3>

                        <p className="cta-card-subtitle">
                            École, structure, communauté ou particulier
                        </p>

                        <p>
                            Vous avez identifié un besoin dans votre école,
                            votre structure ou votre communauté ? Présentez-nous
                            votre situation et votre besoin.
                        </p>

                        <div className="cta-card-tags">

                            <span>École</span>
                            <span>Association</span>
                            <span>Communauté</span>
                            <span>Groupe de jeunes</span>

                        </div>


                        <button
                            type="button"
                            className="cta-card-button"
                            onClick={openInterventionModal}
                        >
                            {showInterventionForm
                                ? "Fermer le formulaire"
                                : "Solliciter une intervention"}
                        </button>

                    </article>


                </div>
                {showYouthForm && (
                    <div
                        className="cta-modal-overlay"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="youth-modal-title"
                        onMouseDown={(e) => {
                            if (e.target === e.currentTarget) {
                                setShowYouthForm(false);
                            }
                        }}
                    >
                        <div className="cta-modal cta-modal-youth">

                            <div className="cta-modal-topbar">
                                <div>
                                    <span className="cta-modal-eyebrow">
                                        PARLER À YOULIDA
                                    </span>

                                    <h2 id="youth-modal-title">
                                        Besoin de parler ?
                                    </h2>
                                </div>

                                <button
                                    type="button"
                                    className="cta-modal-close"
                                    onClick={() => setShowYouthForm(false)}
                                    aria-label="Fermer le formulaire"
                                >
                                    <X size={24} />
                                </button>
                            </div>

                            <div className="cta-modal-body">

                                <div className="youth-form-wrapper">

                                    <div className="youth-form-header">
                                        <span className="cta-section-label">
                                            PARLER À YOULIDA
                                        </span>

                                        <h2>
                                            Besoin de parler ? Nous sommes à votre écoute.
                                        </h2>

                                        <p>
                                            Vous pouvez nous écrire sans donner votre nom.
                                            Expliquez simplement ce que vous souhaitez partager.
                                        </p>
                                    </div>
                                    <form
                                        className="youth-form"
                                        onSubmit={handleYouthSubmit}
                                    >

                                        {/* MESSAGE */}
                                        <div className="youth-form-group">
                                            <label htmlFor="message">
                                                Votre message
                                                <span className="optional"> Facultatif</span>
                                            </label>

                                            <textarea
                                                id="message"
                                                name="message"
                                                rows="6"
                                                placeholder="Écrivez ici ce que vous souhaitez partager avec YOULIDA..."
                                            />
                                        </div>

                                        {/* CATÉGORIE */}
                                        <div className="youth-form-group">
                                            <label htmlFor="category">
                                                De quoi souhaitez-vous parler ?
                                                <span className="optional"> Facultatif</span>
                                            </label>

                                            <select id="category" name="category" defaultValue="">
                                                <option value="">
                                                    Choisir une catégorie
                                                </option>

                                                <option value="ecole">
                                                    École / études
                                                </option>

                                                <option value="famille">
                                                    Famille
                                                </option>

                                                <option value="relations">
                                                    Relations / amitiés
                                                </option>

                                                <option value="bien-etre">
                                                    Santé / bien-être
                                                </option>

                                                <option value="sante-sexuelle">
                                                    Santé sexuelle
                                                </option>

                                                <option value="violence">
                                                    Violence / harcèlement
                                                </option>

                                                <option value="substances">
                                                    Drogues / substances
                                                </option>

                                                <option value="orientation">
                                                    Orientation / avenir
                                                </option>

                                                <option value="autre">
                                                    Autre
                                                </option>

                                                <option value="non-precise">
                                                    Je préfère ne pas préciser
                                                </option>
                                            </select>
                                        </div>

                                        {/* MESSAGE VOCAL */}
                                        <div className="youth-form-group">

                                            <label>
                                                Message vocal
                                                <span className="optional"> Facultatif</span>
                                            </label>

                                            <div className="voice-message-box">

                                                <div className={`voice-icon ${isRecording ? "recording" : ""}`}>
                                                    🎙️
                                                </div>

                                                <div className="voice-content">

                                                    {!isRecording && !audioURL && (
                                                        <>
                                                            <strong>Vous préférez parler ?</strong>

                                                            <p>
                                                                Enregistrez un message vocal puis écoutez-le
                                                                avant de l'envoyer.
                                                            </p>

                                                            <small>
                                                                Durée recommandée : 3 à 5 minutes maximum.
                                                            </small>
                                                        </>
                                                    )}

                                                    {isRecording && (
                                                        <>
                                                            <strong className="recording-text">
                                                                ● Enregistrement en cours...
                                                            </strong>

                                                            <p>
                                                                Parlez normalement. Lorsque vous avez terminé,
                                                                cliquez sur « Arrêter ».
                                                            </p>
                                                        </>
                                                    )}

                                                    {audioURL && !isRecording && (
                                                        <>
                                                            <strong>Votre message vocal est prêt</strong>

                                                            <p>
                                                                Écoutez-le avant de continuer.
                                                            </p>

                                                            <audio
                                                                className="voice-audio-player"
                                                                controls
                                                                src={audioURL}
                                                            >
                                                                Votre navigateur ne prend pas en charge
                                                                la lecture audio.
                                                            </audio>
                                                        </>
                                                    )}

                                                </div>

                                                {!isRecording && !audioURL && (
                                                    <button
                                                        type="button"
                                                        className="voice-record-button"
                                                        onClick={startRecording}
                                                    >
                                                        🎙️ Enregistrer
                                                    </button>
                                                )}

                                                {isRecording && (
                                                    <button
                                                        type="button"
                                                        className="voice-stop-button"
                                                        onClick={stopRecording}
                                                    >
                                                        ■ Arrêter
                                                    </button>
                                                )}

                                                {audioURL && !isRecording && (
                                                    <button
                                                        type="button"
                                                        className="voice-reset-button"
                                                        onClick={resetRecording}
                                                    >
                                                        ↻ Recommencer
                                                    </button>
                                                )}

                                            </div>

                                            {audioError && (
                                                <div className="voice-error">
                                                    {audioError}
                                                </div>
                                            )}

                                        </div>

                                        {/* RAPPEL */}
                                        <div className="youth-form-group">

                                            <label>
                                                Souhaitez-vous que YOULIDA vous recontacte ?
                                            </label>

                                            <div className="callback-options">

                                                <label className="radio-option">
                                                    <input
                                                        type="radio"
                                                        name="callback"
                                                        value="non"
                                                        checked={wantsCallback === "non"}
                                                        onChange={(e) =>
                                                            setWantsCallback(e.target.value)
                                                        }
                                                    />

                                                    Non
                                                </label>

                                                <label className="radio-option">
                                                    <input
                                                        type="radio"
                                                        name="callback"
                                                        value="oui"
                                                        checked={wantsCallback === "oui"}
                                                        onChange={(e) =>
                                                            setWantsCallback(e.target.value)
                                                        }
                                                    />

                                                    Oui
                                                </label>

                                            </div>
                                        </div>

                                        {/* INFORMATIONS DE RAPPEL */}

                                        {wantsCallback === "oui" && (

                                            <div className="callback-fields">

                                                <div className="youth-form-group">

                                                    <label htmlFor="callbackChannel">
                                                        Comment souhaitez-vous être recontacté ?
                                                    </label>

                                                    <select
                                                        id="callbackChannel"
                                                        name="callbackChannel"
                                                        defaultValue="whatsapp"
                                                    >

                                                        <option value="whatsapp">
                                                            WhatsApp
                                                        </option>

                                                        <option value="appel">
                                                            Appel téléphonique
                                                        </option>

                                                        {/* <option value="sms">
                                                SMS
                                            </option> */}

                                                        <option value="email">
                                                            Email
                                                        </option>

                                                        <option value="autre">
                                                            Autre
                                                        </option>

                                                    </select>

                                                </div>

                                                <div className="youth-form-group">

                                                    <label htmlFor="contact">
                                                        Votre contact
                                                    </label>

                                                    <input
                                                        type="text"
                                                        id="contact"
                                                        name="contact"
                                                        placeholder="Numéro de téléphone ou adresse email"
                                                    />

                                                </div>

                                                <div className="youth-form-group">

                                                    <label htmlFor="callbackTime">
                                                        Moment préféré
                                                    </label>

                                                    <select
                                                        id="callbackTime"
                                                        name="callbackTime"
                                                        defaultValue="indifferent"
                                                    >

                                                        <option value="matin">
                                                            Matin
                                                        </option>

                                                        <option value="apres-midi">
                                                            Après-midi
                                                        </option>

                                                        <option value="soir">
                                                            Soir
                                                        </option>

                                                        <option value="indifferent">
                                                            Peu importe
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>
                                        )}

                                        <div className="youth-privacy-note">

                                            <strong>Votre confidentialité compte.</strong>

                                            <p>
                                                Vous pouvez envoyer votre message sans indiquer
                                                votre identité. Un contact est nécessaire uniquement
                                                si vous demandez à être recontacté.
                                            </p>

                                        </div>

                                        {submitError && (
                                            <div className="youth-submit-error">
                                                <strong>Impossible d'envoyer le message.</strong>
                                                <p>{submitError}</p>
                                            </div>
                                        )}

                                        {submitSuccess && (
                                            <div className="youth-submit-success">
                                                <strong>Message envoyé ✓</strong>
                                                <p>{submitSuccess}</p>
                                            </div>
                                        )}


                                        <button
                                            type="submit"
                                            className="youth-submit-button"
                                            disabled={isSubmitting}
                                        >
                                            {isSubmitting ? (
                                                "Envoi en cours..."
                                            ) : (
                                                <>
                                                    Envoyer mon message
                                                    <ArrowRight size={18} />
                                                </>
                                            )}
                                        </button>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                )}

            </section>
            {showPartnerForm && (
                <div
                    className="cta-modal-overlay"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="partner-modal-title"
                    onMouseDown={(e) => {
                        if (e.target === e.currentTarget) {
                            setShowPartnerForm(false);
                        }
                    }}
                >
                    <div className="cta-modal">

                        <div className="cta-modal-topbar">
                            <div>
                                <span className="cta-modal-eyebrow">
                                    PARTENARIAT
                                </span>

                                <h2 id="partner-modal-title">
                                    Devenir partenaire
                                </h2>
                            </div>

                            <button
                                type="button"
                                className="cta-modal-close"
                                onClick={() => setShowPartnerForm(false)}
                                aria-label="Fermer le formulaire"
                            >
                                <X size={24} />
                            </button>
                        </div>

                        <div className="cta-modal-body">

                            <section className="partner-form-section">

                                <div className="partner-form-container">

                                    <div className="partner-form-header">
                                        <span className="partner-form-icon">
                                            🤝
                                        </span>

                                        <div>
                                            <h2>
                                                Devenir partenaire / Collaborer
                                            </h2>

                                            <p>
                                                Vous souhaitez collaborer avec YOULIDA ?
                                                Présentez-nous votre organisation et votre
                                                proposition.
                                            </p>
                                        </div>
                                    </div>

                                    <form onSubmit={handlePartnerSubmit}>

                                        <div className="partner-form-grid">

                                            {/* Organisation */}
                                            <div className="partner-field">
                                                <label htmlFor="partner-organization">
                                                    Organisation *
                                                </label>

                                                <input
                                                    id="partner-organization"
                                                    type="text"
                                                    name="organization"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Nom de votre organisation"
                                                />
                                            </div>


                                            {/* Nom */}
                                            <div className="partner-field">
                                                <label htmlFor="partner-contact-name">
                                                    Nom du contact *
                                                </label>

                                                <input
                                                    id="partner-contact-name"
                                                    type="text"
                                                    name="contact_name"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Nom et prénom"
                                                />
                                            </div>


                                            {/* Fonction */}
                                            <div className="partner-field">
                                                <label htmlFor="partner-function">
                                                    Fonction
                                                </label>

                                                <input
                                                    id="partner-function"
                                                    type="text"
                                                    name="contact_function"
                                                    maxLength="255"
                                                    placeholder="Ex. Responsable de programme"
                                                />
                                            </div>


                                            {/* Email */}
                                            <div className="partner-field">
                                                <label htmlFor="partner-email">
                                                    Adresse e-mail *
                                                </label>

                                                <input
                                                    id="partner-email"
                                                    type="email"
                                                    name="email"
                                                    required
                                                    maxLength="255"
                                                    placeholder="contact@organisation.org"
                                                />
                                            </div>


                                            {/* Téléphone */}
                                            <div className="partner-field partner-field-full">
                                                <label htmlFor="partner-phone">
                                                    Téléphone
                                                    <span> (facultatif)</span>
                                                </label>

                                                <input
                                                    id="partner-phone"
                                                    type="tel"
                                                    name="phone"
                                                    maxLength="50"
                                                    placeholder="+226 ..."
                                                />
                                            </div>


                                            {/* Proposition */}
                                            <div className="partner-field partner-field-full">
                                                <label htmlFor="partner-proposal">
                                                    Votre proposition de collaboration *
                                                </label>

                                                <textarea
                                                    id="partner-proposal"
                                                    name="proposal"
                                                    required
                                                    maxLength="10000"
                                                    rows="6"
                                                    placeholder="Expliquez-nous brièvement comment vous souhaitez collaborer avec YOULIDA..."
                                                />
                                            </div>

                                        </div>


                                        {/* Recontact */}
                                        <div className="partner-callback">

                                            <p className="partner-callback-title">
                                                Souhaitez-vous être recontacté ?
                                            </p>

                                            <div className="partner-radio-group">

                                                <label>
                                                    <input
                                                        type="radio"
                                                        name="wants_callback"
                                                        value="1"
                                                        defaultChecked
                                                        required
                                                    />

                                                    <span>Oui</span>
                                                </label>

                                                <label>
                                                    <input
                                                        type="radio"
                                                        name="wants_callback"
                                                        value="0"
                                                        required
                                                    />

                                                    <span>Non</span>
                                                </label>

                                            </div>

                                        </div>


                                        {/* Erreur */}
                                        {partnerError && (
                                            <div className="partner-message partner-message-error">
                                                {partnerError}
                                            </div>
                                        )}


                                        {/* Succès */}
                                        {partnerSuccess && (
                                            <div className="partner-message partner-message-success">
                                                ✓ {partnerSuccess}
                                            </div>
                                        )}


                                        <div className="partner-submit-wrapper">

                                            <button
                                                type="submit"
                                                className="partner-submit-button"
                                                disabled={partnerSubmitting}
                                            >
                                                {partnerSubmitting
                                                    ? "Envoi en cours..."
                                                    : "Envoyer ma proposition"}
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            )}


            {showInterventionForm && (
                <div
                    className="cta-modal-overlay"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="intervention-modal-title"
                    onMouseDown={(e) => {
                        if (e.target === e.currentTarget) {
                            setShowInterventionForm(false);
                        }
                    }}
                >
                    <div className="cta-modal cta-modal-large">

                        <div className="cta-modal-topbar">
                            <div>
                                <span className="cta-modal-eyebrow">
                                    INTERVENTION
                                </span>

                                <h2 id="intervention-modal-title">
                                    Solliciter une intervention
                                </h2>
                            </div>

                            <button
                                type="button"
                                className="cta-modal-close"
                                onClick={() => setShowInterventionForm(false)}
                                aria-label="Fermer le formulaire"
                            >
                                <X size={24} />
                            </button>
                        </div>

                        <div className="cta-modal-body">

                            <section className="intervention-form-section">

                                <div className="intervention-form-container">

                                    <div className="intervention-form-header">
                                        <span className="intervention-form-icon">
                                            📣
                                        </span>

                                        <div>
                                            <h2>
                                                Solliciter une intervention
                                            </h2>

                                            <p>
                                                Vous souhaitez faire intervenir YOULIDA
                                                auprès d'un public ? Décrivez-nous votre besoin.
                                            </p>
                                        </div>
                                    </div>


                                    <form onSubmit={handleInterventionSubmit}>

                                        <div className="intervention-form-grid">

                                            {/* Type de structure */}
                                            <div className="intervention-field">

                                                <label htmlFor="structure-type">
                                                    Type de structure *
                                                </label>

                                                <select
                                                    id="structure-type"
                                                    name="structure_type"
                                                    required
                                                >
                                                    <option value="">
                                                        Sélectionnez
                                                    </option>

                                                    <option value="ecole">
                                                        École / établissement
                                                    </option>

                                                    <option value="communaute">
                                                        Communauté
                                                    </option>

                                                    <option value="association">
                                                        Association
                                                    </option>

                                                    <option value="groupe_jeunes">
                                                        Groupe de jeunes
                                                    </option>

                                                    <option value="evenement">
                                                        Événement
                                                    </option>

                                                    <option value="autre">
                                                        Autre
                                                    </option>
                                                </select>

                                            </div>


                                            {/* Nom structure */}
                                            <div className="intervention-field">

                                                <label htmlFor="structure-name">
                                                    Nom de la structure
                                                </label>

                                                <input
                                                    id="structure-name"
                                                    type="text"
                                                    name="structure_name"
                                                    maxLength="255"
                                                    placeholder="Nom de l'établissement ou organisation"
                                                />

                                            </div>


                                            {/* Contact */}
                                            <div className="intervention-field">

                                                <label htmlFor="intervention-contact">
                                                    Nom du contact *
                                                </label>

                                                <input
                                                    id="intervention-contact"
                                                    type="text"
                                                    name="contact_name"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Nom et prénom"
                                                />

                                            </div>


                                            {/* Fonction */}
                                            <div className="intervention-field">

                                                <label htmlFor="intervention-function">
                                                    Fonction
                                                </label>

                                                <input
                                                    id="intervention-function"
                                                    type="text"
                                                    name="contact_function"
                                                    maxLength="255"
                                                    placeholder="Ex. Directeur, coordinateur..."
                                                />

                                            </div>


                                            {/* Téléphone */}
                                            <div className="intervention-field">

                                                <label htmlFor="intervention-phone">
                                                    Téléphone
                                                </label>

                                                <input
                                                    id="intervention-phone"
                                                    type="tel"
                                                    name="phone"
                                                    maxLength="50"
                                                    placeholder="+226 ..."
                                                />

                                            </div>


                                            {/* Email */}
                                            <div className="intervention-field">

                                                <label htmlFor="intervention-email">
                                                    E-mail
                                                </label>

                                                <input
                                                    id="intervention-email"
                                                    type="email"
                                                    name="email"
                                                    maxLength="255"
                                                    placeholder="contact@exemple.com"
                                                />

                                                <small>
                                                    Téléphone ou e-mail :
                                                    au moins l'un des deux est obligatoire.
                                                </small>

                                            </div>


                                            {/* Lieu */}
                                            <div className="intervention-field intervention-field-full">

                                                <label htmlFor="intervention-location">
                                                    Lieu de l'intervention *
                                                </label>

                                                <input
                                                    id="intervention-location"
                                                    type="text"
                                                    name="location"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Ville, quartier, établissement..."
                                                />

                                            </div>


                                            {/* Besoin */}
                                            <div className="intervention-field intervention-field-full">

                                                <label htmlFor="intervention-need">
                                                    Besoin / situation *
                                                </label>

                                                <textarea
                                                    id="intervention-need"
                                                    name="need"
                                                    required
                                                    maxLength="10000"
                                                    rows="5"
                                                    placeholder="Expliquez l'intervention souhaitée et le contexte..."
                                                />

                                            </div>


                                            {/* Public */}
                                            <div className="intervention-field">

                                                <label htmlFor="target-audience">
                                                    Public concerné *
                                                </label>

                                                <input
                                                    id="target-audience"
                                                    type="text"
                                                    name="target_audience"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Ex. Adolescents de 14 à 18 ans"
                                                />

                                            </div>


                                            {/* Participants */}
                                            <div className="intervention-field">

                                                <label htmlFor="estimated-participants">
                                                    Nombre approximatif
                                                </label>

                                                <input
                                                    id="estimated-participants"
                                                    type="number"
                                                    name="estimated_participants"
                                                    min="1"
                                                    max="1000000"
                                                    placeholder="Ex. 50"
                                                />

                                            </div>


                                            {/* Période */}
                                            <div className="intervention-field intervention-field-full">

                                                <label htmlFor="desired-period">
                                                    Période souhaitée
                                                </label>

                                                <input
                                                    id="desired-period"
                                                    type="text"
                                                    name="desired_period"
                                                    maxLength="255"
                                                    placeholder="Ex. Novembre 2026, semaine du 10 novembre..."
                                                />

                                            </div>

                                        </div>


                                        {/* Format */}
                                        <div className="intervention-format">

                                            <p className="intervention-format-title">
                                                Type d'intervention *
                                            </p>

                                            <div className="intervention-radio-group">

                                                <label>
                                                    <input
                                                        type="radio"
                                                        name="intervention_format"
                                                        value="ponctuelle"
                                                        checked={interventionFormat === "ponctuelle"}
                                                        onChange={(e) =>
                                                            setInterventionFormat(e.target.value)
                                                        }
                                                    />

                                                    <span>
                                                        Intervention ponctuelle
                                                    </span>
                                                </label>


                                                <label>
                                                    <input
                                                        type="radio"
                                                        name="intervention_format"
                                                        value="duree"
                                                        checked={interventionFormat === "duree"}
                                                        onChange={(e) =>
                                                            setInterventionFormat(e.target.value)
                                                        }
                                                    />

                                                    <span>
                                                        Intervention sur une durée
                                                    </span>
                                                </label>

                                            </div>

                                        </div>


                                        {/* Durée conditionnelle */}
                                        {interventionFormat === "duree" && (

                                            <div className="intervention-field intervention-duration">

                                                <label htmlFor="intervention-duration">
                                                    Durée souhaitée *
                                                </label>

                                                <input
                                                    id="intervention-duration"
                                                    type="text"
                                                    name="duration"
                                                    required
                                                    maxLength="255"
                                                    placeholder="Ex. 3 jours, 4 semaines..."
                                                />

                                            </div>

                                        )}


                                        {/* Informations complémentaires */}
                                        <div className="intervention-field intervention-additional">

                                            <label htmlFor="additional-information">
                                                Informations complémentaires
                                            </label>

                                            <textarea
                                                id="additional-information"
                                                name="additional_information"
                                                rows="4"
                                                maxLength="10000"
                                                placeholder="Ajoutez toute information utile..."
                                            />

                                        </div>


                                        {/* Erreur */}
                                        {interventionError && (
                                            <div className="intervention-message intervention-message-error">
                                                {interventionError}
                                            </div>
                                        )}


                                        {/* Succès */}
                                        {interventionSuccess && (
                                            <div className="intervention-message intervention-message-success">
                                                ✓ {interventionSuccess}
                                            </div>
                                        )}


                                        <div className="intervention-submit-wrapper">

                                            <button
                                                type="submit"
                                                className="intervention-submit-button"
                                                disabled={interventionSubmitting}
                                            >
                                                {interventionSubmitting
                                                    ? "Envoi en cours..."
                                                    : "Envoyer ma demande"}
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            )}


            {/* =========================
          AUTRES FAÇONS DE SOUTENIR
      ========================= */}
            <section className="cta-support">

                <div className="cta-support-content">

                    <div className="cta-support-icon">
                        <Heart size={28} />
                    </div>

                    <div>
                        <span className="cta-section-label">
                            AUTRES FAÇONS DE SOUTENIR YOULIDA
                        </span>

                        <h2>
                            Vous souhaitez contribuer autrement ?
                        </h2>

                        <p>
                            Découvrez également nos possibilités de bénévolat
                            et de soutien financier.
                        </p>
                    </div>

                </div>

                <div className="cta-support-actions">

                    <button
                        type="button"
                        className="cta-support-button"
                        onClick={openVolunteerModal}
                    >
                        <Gift size={18} />

                        {showVolunteerForm
                            ? "Fermer le formulaire"
                            : "Devenir bénévole"}
                    </button>

                    <button
                        type="button"
                        className="cta-support-button"
                        onClick={openDonationModal}
                    >
                        Faire un don
                        <ArrowRight size={18} />
                    </button>

                </div>

            </section>
           {showVolunteerForm && (
    <div
        className="cta-modal-overlay"
        role="dialog"
        aria-modal="true"
        aria-labelledby="volunteer-modal-title"
        onMouseDown={(e) => {
            if (e.target === e.currentTarget) {
                setShowVolunteerForm(false);
            }
        }}
    >
        <div className="cta-modal">

            <div className="cta-modal-topbar">
                <div>
                    <span className="cta-modal-eyebrow">
                        REJOINDRE YOULIDA
                    </span>

                    <h2 id="volunteer-modal-title">
                        Devenir bénévole
                    </h2>
                </div>

                <button
                    type="button"
                    className="cta-modal-close"
                    onClick={() => setShowVolunteerForm(false)}
                    aria-label="Fermer le formulaire"
                >
                    <X size={24} />
                </button>
            </div>

            <div className="cta-modal-body">

                <section className="volunteer-form-section">

                    <div className="volunteer-form-container">

                        <div className="volunteer-form-header">
                            <span className="cta-section-label">
                                REJOINDRE YOULIDA
                            </span>

                            <h2>
                                Devenir bénévole
                            </h2>

                            <p>
                                Vous souhaitez mettre votre temps, vos compétences
                                ou votre expérience au service des actions de YOULIDA ?
                                Présentez-vous en quelques mots.
                            </p>
                        </div>

                        {volunteerSuccess && (
                            <div className="volunteer-success">
                                {volunteerSuccess}
                            </div>
                        )}

                        {volunteerError && (
                            <div className="volunteer-error">
                                {volunteerError}
                            </div>
                        )}

                        <form
                            className="volunteer-form"
                            onSubmit={handleVolunteerSubmit}
                        >

                            <div className="volunteer-form-grid">

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-name">
                                        Nom *
                                    </label>

                                    <input
                                        id="volunteer-name"
                                        type="text"
                                        name="name"
                                        required
                                        maxLength="255"
                                        placeholder="Votre nom"
                                    />
                                </div>

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-prenom">
                                        Prénom
                                    </label>

                                    <input
                                        id="volunteer-prenom"
                                        type="text"
                                        name="prenom"
                                        maxLength="255"
                                        placeholder="Votre prénom"
                                    />
                                </div>

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-email">
                                        Adresse e-mail
                                    </label>

                                    <input
                                        id="volunteer-email"
                                        type="email"
                                        name="email"
                                        maxLength="255"
                                        placeholder="exemple@email.com"
                                    />
                                </div>

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-phone">
                                        Téléphone
                                    </label>

                                    <input
                                        id="volunteer-phone"
                                        type="tel"
                                        name="telephone"
                                        maxLength="255"
                                        placeholder="+226..."
                                    />
                                </div>

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-country">
                                        Pays
                                    </label>

                                    <input
                                        id="volunteer-country"
                                        type="text"
                                        name="pays"
                                        maxLength="255"
                                        placeholder="Votre pays"
                                    />
                                </div>

                                <div className="volunteer-field">
                                    <label htmlFor="volunteer-city">
                                        Ville
                                    </label>

                                    <input
                                        id="volunteer-city"
                                        type="text"
                                        name="ville"
                                        maxLength="255"
                                        placeholder="Votre ville"
                                    />
                                </div>

                            </div>

                            <div className="volunteer-field">
                                <label htmlFor="volunteer-motivation">
                                    Pourquoi souhaitez-vous devenir bénévole ?
                                </label>

                                <textarea
                                    id="volunteer-motivation"
                                    name="motivation"
                                    rows="5"
                                    placeholder="Parlez-nous brièvement de votre motivation, de vos compétences ou de la manière dont vous aimeriez contribuer..."
                                />
                            </div>

                            <button
                                type="submit"
                                className="volunteer-submit-button"
                                disabled={volunteerLoading}
                            >
                                {volunteerLoading
                                    ? "Envoi en cours..."
                                    : "Envoyer ma candidature"}
                            </button>

                        </form>

                    </div>

                </section>

            </div>
        </div>
    </div>
)}



           {showDonationSection && (
    <div
        className="cta-modal-overlay"
        role="dialog"
        aria-modal="true"
        aria-labelledby="donation-modal-title"
        onMouseDown={(e) => {
            if (e.target === e.currentTarget) {
                setShowDonationSection(false);
            }
        }}
    >
        <div className="cta-modal cta-modal-small">

            <div className="cta-modal-topbar">
                <div>
                    <span className="cta-modal-eyebrow">
                        SOUTENIR YOULIDA
                    </span>

                    <h2 id="donation-modal-title">
                        Faire un don
                    </h2>
                </div>

                <button
                    type="button"
                    className="cta-modal-close"
                    onClick={() => setShowDonationSection(false)}
                    aria-label="Fermer"
                >
                    <X size={24} />
                </button>
            </div>

            <div className="cta-modal-body">

                <section
                    id="don"
                    className="donation-section"
                >
                    <div className="donation-container">

                        <div className="donation-header">

                            <span className="cta-section-label">
                                SOUTENIR YOULIDA
                            </span>

                            <h2>
                                Faire un don
                            </h2>

                            <p>
                                Votre soutien contribue à la réalisation des actions
                                de YOULIDA en faveur des jeunes.
                            </p>

                        </div>

                        <div className="donation-notice">

                            <Heart size={24} />

                            <div>
                                <strong>
                                    Merci pour votre volonté de soutenir YOULIDA.
                                </strong>

                                <p>
                                    Le paiement en ligne sera prochainement disponible.
                                    Pour effectuer un don actuellement, contactez
                                    directement l'équipe YOULIDA afin de recevoir
                                    les informations nécessaires.
                                </p>
                            </div>

                        </div>

                        <div className="donation-actions">

                            <a
                                href="https://wa.me/message/V2TTCFZB6NFIB1"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="donation-primary-button"
                            >
                                Contacter YOULIDA sur WhatsApp
                            </a>

                            <a
                                href="tel:+22673525290"
                                className="donation-secondary-button"
                            >
                                Appeler YOULIDA
                            </a>

                        </div>

                        <p className="donation-security">
                            Ne transmettez jamais vos informations bancaires,
                            votre code PIN ou un code de validation par message.
                        </p>

                    </div>
                </section>

            </div>
        </div>
    </div>
)}

            {/* =========================
          MESSAGE FINAL
      ========================= */}
            <section className="cta-final">

                <div className="cta-final-content">

                    <h2>
                        Chaque échange peut être le début
                        d'une nouvelle possibilité.
                    </h2>

                    <p>
                        Choisissez le parcours qui correspond à votre situation.
                        YOULIDA est là pour vous écouter, collaborer et agir.
                    </p>

                </div>

            </section>

        </div>
    );
}
