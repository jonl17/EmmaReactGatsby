// import React from "react"
// import { graphql } from "gatsby"
// import Wrap from "../components/Wrap"
// import { NewsGrid } from "../components/Grid"
// import { connect } from "react-redux"
// import { GlobalStyles } from "../components/GlobalStyles.js"
// import Container from "../components/WorksContainer"

// const WorkTemplate = ({ data, device }) => {
//   console.log(data.wordpressWpWorks)
//   return (
//     <>
//       <GlobalStyles></GlobalStyles>
//       <Wrap>
//         <NewsGrid device={device}>
//           <Container artwork={data.wordpressWpWorks}></Container>
//         </NewsGrid>
//       </Wrap>
//     </>
//   )
// }

// export const query = graphql`
//   query($slug: String) {
//     wordpressWpWorks(slug: { eq: $slug }) {
//       title
//       slug
//       acf {
//         description
//         material
//         year
//         myndir {
//           mynd {
//             undirtexti
//             texti
//             myndaskra {
//               localFile {
//                 childImageSharp {
//                   fluid {
//                     ...GatsbyImageSharpFluid
//                   }
//                 }
//               }
//             }
//           }
//         }
//       }
//     }
//   }
// `

// const mapStateToProps = state => ({
//   device: state.reducer.device,
// })

// export default connect(mapStateToProps)(WorkTemplate)
