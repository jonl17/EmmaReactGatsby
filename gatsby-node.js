// Implement the Gatsby API “createPages”. This is called once the
// data layer is bootstrapped to let plugins create pages from data.
const path = require("path")

const sharp = require("sharp")

sharp.cache(false)
sharp.simd(true)
