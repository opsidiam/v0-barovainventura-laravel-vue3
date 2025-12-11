import Link from "next/link"

interface BreadcrumbProps {
  title: string
  subtitle?: string
  items: { label: string; href?: string }[]
}

export function Breadcrumb({ title, subtitle, items }: BreadcrumbProps) {
  return (
    <div className="gradient-bg pt-32 pb-16 relative overflow-hidden">
      {/* Decorative shapes */}
      <div className="absolute top-20 left-10 w-20 h-20 bg-pink-500/20 rounded-full blur-xl" />
      <div className="absolute top-40 right-20 w-32 h-32 bg-blue-500/20 rounded-full blur-xl" />
      <div className="absolute bottom-10 left-1/3 w-24 h-24 bg-purple-500/20 rounded-full blur-xl" />

      <div className="container mx-auto px-4 relative z-10">
        <div className="text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">{title}</h1>
          {subtitle && <p className="text-white/80 text-lg max-w-2xl mx-auto mb-6">{subtitle}</p>}
          <nav className="flex items-center justify-center gap-2 text-white/70">
            {items.map((item, index) => (
              <span key={index} className="flex items-center gap-2">
                {index > 0 && <span>»</span>}
                {item.href ? (
                  <Link href={item.href} className="hover:text-white transition">
                    {item.label}
                  </Link>
                ) : (
                  <span className="text-white">{item.label}</span>
                )}
              </span>
            ))}
          </nav>
        </div>
      </div>
    </div>
  )
}
