disable_warnings = false

# Custom remove all comments
class Sass::Tree::Visitors::Perform < Sass::Tree::Visitors::Base
  # Removes all comments completely
  def visit_comment(node)
    return []
  end
end