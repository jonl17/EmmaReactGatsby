// Implement the Gatsby API “createPages”. This is called once the
// data layer is bootstrapped to let plugins create pages from data.
const path = require("path")

const sharp = require("sharp")

sharp.cache(false)
sharp.simd(true)

exports.createPages = ({ graphql, actions }) => {
  const { createPage } = actions
  return new Promise((resolve, reject) => {
    const workTemplate = path.resolve(`src/templates/work.js`)
    const videoWorkTemplate = path.resolve(`src/templates/videoWork.js`)
    // Query for markdown nodes to use in creating pages.
    resolve(
      graphql(
        `
          {
            allWordpressWpWorks {
              edges {
                node {
                  title
                  slug
                  acf {
                    videowork
                  }
                }
              }
            }
          }
        `
      ).then(result => {
        if (result.errors) {
          console.log("error")
          reject(result.errors)
        }
        // Create pages for each work.
        result.data.allWordpressWpWorks.edges.forEach(({ node }) => {
          const path = node.slug
          if (node.acf.videowork) {
            createPage({
              path: "Works/" + path,
              component: videoWorkTemplate,
              context: {
                slug: path,
                pagename: node.title,
              },
            })
          } else {
            createPage({
              path: "Works/" + path,
              component: workTemplate,
              context: {
                slug: path,
                pagename: node.title,
              },
            })
          }
        })
      })
    )
  })
}
