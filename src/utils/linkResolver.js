export const linkResolver = doc => {
  if (doc.type === "work") {
    return `/work/${doc.uid}`
  }

  if (doc.type === "page") {
    return `/${doc.uid}`
  }

  // Backup for all other types
  return "/"
}
