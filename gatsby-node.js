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
    // Query for markdown nodes to use in creating pages.
    resolve(
      graphql(
        `
          {
            allWordpressWpWorks {
              edges {
                node {
                  slug
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
          createPage({
            path,
            component: workTemplate,
            // In your blog post template's graphql query, you can use path
            // as a GraphQL variable to query for data from the markdown file.
            context: {
              slug: path,
            },
          })
        })
      })
    )
  })
}
