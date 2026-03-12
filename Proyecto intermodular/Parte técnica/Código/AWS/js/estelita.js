window.addEventListener("message", function (event) {
  if (event.origin !== "https://www.estel2026.duckdns.org") return;

  if (!event.data) return;

  try {
    const data = typeof event.data === "string" ? JSON.parse(event.data) : event.data;
    if (!data.queryResult) return;

    const action = data.queryResult.action;
    // Normalizamos el texto: minúsculas y quitamos acentos
    const texto = (data.queryResult.queryText || "")
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, ""); 

    /* ============================
       NAVEGACIÓN DE PACIENTE
    ============================ */
    if (action === "patient.navigate" || action === "patient.navigate_en") {
      if (texto.includes("juego") || texto.includes("game") || texto.includes("play")) {
        window.location.href = "/paciente/juegos";
      } else if (texto.includes("foto") || texto.includes("photo")) {
        window.location.href = "/paciente/fotos";
      } else if (texto.includes("musica") || texto.includes("music") || texto.includes("playlist")) {
        window.location.href = "/paciente/musica";
      } else if (texto.includes("recordatorio") || texto.includes("reminder")) {
        window.location.href = "/paciente/recordatorios";
      } else if (texto.includes("medicacion") || texto.includes("medication") || texto.includes("treatment")) {
        window.location.href = "/paciente/medicacion";
      } else {
        // Si no entiende la palabra clave, lo lleva al panel principal
        window.location.href = "/paciente";
      }
      return;
    }

    /* ============================
       NAVEGACIÓN DE CUIDADOR
    ============================ */
    if (action === "caregiver.navigate" || action === "caregiver.navigate_en") {
      if (texto.includes("recordatorio") || texto.includes("reminder")) {
        window.location.href = "/cuidador/recordatorios";
      } else if (texto.includes("medicacion") || texto.includes("medication") || texto.includes("treatment")) {
        window.location.href = "/cuidador/medicacion";
      } else if (texto.includes("foto") || texto.includes("photo")) {
        window.location.href = "/cuidador/fotos";
      } else if (texto.includes("musica") || texto.includes("music")) {
        window.location.href = "/cuidador/musica";
      } else {
        window.location.href = "/cuidador";
      }
      return;
    }

    /* ============================
       SELECCIÓN DE ROL
    ============================ */
    if (action === "user.role" || action === "user.role_en") {
      if (texto.includes("paciente") || texto.includes("patient")) {
        window.location.href = "/paciente";
      } else if (texto.includes("cuidador") || texto.includes("caregiver") || texto.includes("carer")) {
        window.location.href = "/cuidador";
      }
      return;
    }

  } catch (error) {
    console.error("Error en la navegación de Estelita:", error);
  }
});
